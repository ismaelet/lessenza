<?php

namespace App\Models;

use App\Mail\ContactMail;
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
use Symfony\Component\Mailer\Exception\UnexpectedResponseException;

class Order extends Model {

    /**
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'user_id',
        'address_id',
        'shipping_method_id',
        'payment_method_id',
        'price',
        'item_price',
        'shipping_fee',
        'status',
        'token',
    ];

    /**
     * Attribute: Get the order ID code
     */
    public function idCode(): Attribute {
        return new Attribute(
            get: fn() => '#' . str_pad($this->id, 6, '0', STR_PAD_LEFT)
        );
    }

    /**
     * Relationship: Get the address associated with the order
     */
    public function address(): BelongsTo {
        return $this->belongsTo(Address::class);
    }

    /**
     * Relationship: Get the order items associated with the order
     */
    public function order_items(): HasMany {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relationship: Get the shipping method associated with the order
     */
    public function shipping_method(): BelongsTo {
        return $this->belongsTo(ShippingMethod::class);
    }

    /**
     * Relationship: Get the payment method associated with the order
     */
    public function payment_method(): BelongsTo {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Get the date of the order item
     */
    public function date(): string {
        return $this->created_at->format('d/m/Y');
    }

    /**
     * Get the label for the order status
     */
    public function statusTag(): string {
        return config('custom.order_statuses.' . $this->status . '.tag', 'unknown');
    }

    /**
     * Get the tag for the order status
     */
    public function statusLabel(): string {
        return config('custom.order_statuses.' . $this->status . '.label', 'Unknown Status');
    }

    /**
     * Calculate the current price of the order, based on the currrent product prices and shipping fees
     */
    public function dynamicPrice(): float {
        return $this->dynamicItemPrice() + $this->dynamicShippingFee();
    }

    /**
     * Calculate the total price of the items in the order
     */
    public function dynamicItemPrice(): float {
        $price = 0;

        foreach ($this->order_items as $orderItem) {
            $price += $orderItem->price;
        }

        return $price;
    }

    /**
     * Calculate the shipping fee of the order
     */
    public function dynamicShippingFee(): float {
        return $this->shipping_method->price($this) ?? 0.0;
    }

    /**
     * Get the total quantity of items in the order
     */
    public function quantity(): int {
        $quantity = 0;

        foreach ($this->order_items as $orderItem) {
            $quantity += $orderItem->quantity;
        }

        return $quantity;
    }

    /**
     * Check if the order is empty
     */
    public function isEmpty(): bool {
        return $this->order_items->isEmpty();
    }

    /**
     * Get the recap URL with token
     */
    public function recapUrlWithToken(): string {
        return route('order.show', ['order' => $this, 'token' => $this->token]);
    }

    /**
     * Update the order prices based on the current product prices and shipping fees
     */
    public function updatePrice(): void {
        $this->load('order_items', 'order_items.product');

        $this->order_items->each(function (OrderItem $orderItem) {
            $orderItem->updatePrice($this->quantity());
        });

        $this->price = $this->dynamicPrice();
        $this->item_price = $this->dynamicItemPrice();
        $this->shipping_fee = $this->dynamicShippingFee();
        $this->save();
    }

    /**
     * Add a product to the order
     */
    public function add(Product $product, int $quantity = 1, bool $extraConcentrated = false): void {
        $orderItem = $this->order_items()->where('product_id', $product->id)->first();

        $newOrderQuantity = $this->quantity() + $quantity;

        if ($orderItem) {
            // If the order item already exists, update the quantity
            $orderItem->update([
                'quantity' => $orderItem->quantity + $quantity,
                'extra_concentrated' => $extraConcentrated,
            ]);

            $orderItem->updatePrice($newOrderQuantity);
        } else {
            // Otherwise, create a new order item
            $orderItem = $this->order_items()->create([
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'quantity' => $quantity,
                'price' => 0,
                'product_price' => 0,
                'extra_concentrated' => $extraConcentrated,
            ]);

            $orderItem->updatePrice($newOrderQuantity);
        }

        $this->updatePrice();
    }

    /**
     * Remove an order item from the order
     */
    public function removeItem(OrderItem $orderItem): void {
        $orderItem->delete();

        $this->updatePrice();
    }

    /**
     * Confirm the order
     */
    public function confirm($sendNotification = true): void {
        session()->forget('cartId');

        if ($this->status) {
            return;
        }

        // Update the order status and timestamps
        $this->update([
            'created_at' => now(),
            'status' => 1,
        ]);

        // Send the confirmation email
        if ($sendNotification) {
            $this->sendStatusEmail();
            $this->sendCCMail();
        }
    }

    /**
     * Send the order status email
     */
    public function sendStatusEmail(): void {
        if (app()->environment('local')) {
            return;
        }

        $email = $this->address->email;

        try {
            Mail::to($email)->send(new OrderStatusMail($this));
        } catch (UnexpectedResponseException $e) {
            Log::info("Email sending failed for {$email}: " . $e->getMessage());
        }
    }

    /**
     * Send a copy of the order status email to a specific address
     */
    public function sendCCMail(): void {
        $email = 'commerciale@lessenza.net';
        $name = $this->address->full_name;
        $clientEmail = $this->address->email;

        try {
            Mail::to($email)
                ->send(new OrderConfirmationCCMail(
                    email: $clientEmail,
                    name: $name
                ));
        } catch (TransportExceptionInterface $e) {
            Log::info("Email sending failed for {$email}: " . $e->getMessage());
        }
    }
}
