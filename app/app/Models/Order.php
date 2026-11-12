<?php

namespace App\Models;

use App\Helpers\EcommerceHelper;
use App\Mail\OrderConfirmationCCMail;
use App\Mail\OrderStatusMail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class Order extends Model
{
    public const VAT = 0.22;

    /**
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'user_id',
        'address_id',
        'shipping_method_id',
        'payment_method_id',
        'items_price_net',
        'shipping_fee_net',
        'total_price_gross',
        'vat',
        'quantity',
        'status',
        'token',
        'created_at',
    ];

    /**
     * Attribute: Get the order ID code
     */
    public function idCode(): Attribute
    {
        return new Attribute(
            get: fn () => '#'.str_pad($this->id, 6, '0', STR_PAD_LEFT)
        );
    }

    /**
     * Relationship: Get the address associated with the order
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Relationship: Get the order items associated with the order
     */
    public function order_items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relationship: Get the shipping method associated with the order
     */
    public function shipping_method(): BelongsTo
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    /**
     * Relationship: Get the payment method associated with the order
     */
    public function payment_method(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Get the label for the order status
     */
    public function statusTag(): string
    {
        return config('ecommerce.order_statuses.'.$this->status.'.tag', 'unknown');
    }

    /**
     * Get the tag for the order status
     */
    public function statusLabel(): string
    {
        return config('ecommerce.order_statuses.'.$this->status.'.label', 'Unknown Status');
    }

    /**
     * Get the icon for the order status
     */
    public function statusIcon(): string
    {
        return config('ecommerce.order_statuses.'.$this->status.'.icon', 'Unknown Status');
    }

    /**
     * Calculate the total price of the items in the order
     */
    private function calcItemsPriceNet(): float
    {
        return $this->order_items()->sum('total_price_net');
    }

    /**
     * Calculate the shipping fee of the order
     */
    private function calcShippingFeeNet(): float
    {
        return $this->shipping_method->price($this) ?? 0;
    }

    /**
     * Calculate the VAT of the order
     */
    private function calcVat(): float
    {
        return $this->calcTotalPriceNet() * self::VAT;
    }

    /**
     * Calculate the total net price of the order
     */
    private function calcTotalPriceNet(): float
    {
        return $this->calcItemsPriceNet() + $this->calcShippingFeeNet();
    }

    /**
     * Calculate the total gross price of the order
     */
    private function calcTotalPriceGross(): float
    {
        return $this->calcTotalPriceNet() + $this->calcVat();
    }

    /**
     * Get the total quantity of items in the order
     */
    private function calcQuantity(): int
    {
        return $this->order_items()->sum('quantity');
    }

    /**
     * Update the order prices based on the current product prices and shipping fees
     */
    public function recalculatePrices(): void
    {
        $this->quantity = $this->calcQuantity();

        $this->order_items()->each(function (OrderItem $orderItem) {
            $orderItem->load('product');
            $orderItem->recalculatePrices($this->quantity);
        });

        $this->items_price_net = $this->calcItemsPriceNet();
        $this->shipping_fee_net = $this->calcShippingFeeNet();
        $this->vat = $this->calcVat();
        $this->total_price_gross = $this->calcTotalPriceGross();
        $this->save();
    }

    /**
     * Check if the order is empty
     */
    public function isEmpty(): bool
    {
        return $this->order_items->isEmpty();
    }

    /**
     * Get the date of the order item
     */
    public function date(): string
    {
        return $this->created_at->format('d/m/Y');
    }

    /**
     * Get the recap URL with token
     */
    public function recapUrlWithToken(): string
    {
        return route('order.show', ['order' => $this, 'token' => $this->token]);
    }

    /**
     * Create a new cart order
     */
    public static function createCart(): Order
    {
        $order = self::create([
            'user_id' => Auth::id(),
            'shipping_method_id' => ShippingMethod::default()?->id,
            'payment_method_id' => PaymentMethod::default()?->id,
        ]);

        session(['cart_id' => $order->id]);

        return $order;
    }

    /**
     * Add a product to the order
     */
    public function add(Product $product, int $quantity = 1, bool $extraConcentrated = false): void
    {
        $orderItem = $this->order_items()->where('product_id', $product->id)->first();

        if ($orderItem) {
            // If the order item already exists, update the quantity
            $orderItem->update([
                'quantity' => $orderItem->quantity + $quantity,
                'extra_concentrated' => $extraConcentrated,
            ]);
        } else {
            // Otherwise, create a new order item
            $orderItem = $this->order_items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'extra_concentrated' => $extraConcentrated,
            ]);
        }

        $this->recalculatePrices();
    }

    /**
     * Remove an order item from the order
     */
    public function removeItem(OrderItem $orderItem): void
    {
        $orderItem->delete();

        $this->recalculatePrices();
    }

    /**
     * Confirm the order
     */
    public function confirm($sendNotification = true): void
    {
        session()->forget('cart_id');

        if ($this->status) {
            return;
        }

        // Update the order status and timestamps
        $this->update([
            'created_at' => now(),
            'status' => EcommerceHelper::status('payment_pending'),
        ]);

        // Send the confirmation email
        if ($sendNotification) {
            $this->load('order_items.product');
            $this->sendStatusEmail();
            $this->sendCCMail();
        }
    }

    /**
     * Update the order status
     */
    public function updateStatus(int $newStatusId, bool $sendNotification = true): void
    {
        $this->update([
            'status' => $newStatusId,
        ]);

        if ($sendNotification) {
            $this->load('order_items.product');
            $this->sendStatusEmail();
        }
    }

    /**
     * Send the order status email
     */
    private function sendStatusEmail(): void
    {
        $email = $this->address->email;

        try {
            Mail::to($email)->send(new OrderStatusMail($this));
        } catch (TransportExceptionInterface $e) {
            Log::warning("SMTP error for {$email}: ".$e->getMessage());
        } catch (\Throwable $e) {
            Log::error("Unexpected mail error for {$email}: ".$e->getMessage());
        }
    }

    /**
     * Send a copy of the order status email to a specific address
     */
    private function sendCCMail(): void
    {
        $name = $this->address->full_name;
        $clientEmail = $this->address->email;

        try {
            Mail::to(config('custom.notification_emails'))
                ->send(new OrderConfirmationCCMail(
                    email: $clientEmail,
                    name: $name
                ));
        } catch (TransportExceptionInterface $e) {
            Log::warning('SMTP error for '.implode(', ', config('custom.notification_emails')).': '.$e->getMessage());
        } catch (\Throwable $e) {
            Log::error('Unexpected mail error for '.implode(', ', config('custom.notification_emails')).': '.$e->getMessage());
        }
    }
}
