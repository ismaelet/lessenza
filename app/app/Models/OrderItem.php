<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    /**
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'unit_price_net',
        'total_price_net',
        'extra_concentrated',
        'quantity',
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
     * Attribute: Get the name of the order item
     */
    public function name(): Attribute
    {
        return Attribute::make(
            get: fn (): string => ($this->product?->name ?? '-').($this->extra_concentrated ? ' (extra concentrata)' : ''),
        );
    }

    /**
     * Attribute: Get the name of the order item
     */
    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->quantity.' x '.$this->name
        );
    }

    /**
     * Relationship: Get the order associated with the order item
     */
    private function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relationship: Get the product associated with the order item
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Calculate the current price of the order item, based on the current product price
     */
    private function calcTotalPriceNet(int $totalOrderQuantity): float
    {
        return $this->quantity * ($this->calcUnitPriceNet($totalOrderQuantity));
    }

    /**
     * Get the dynamic product price based on the current product price
     */
    private function calcUnitPriceNet(int $totalOrderQuantity): float
    {
        return $this->product->price($totalOrderQuantity, $this->extra_concentrated);
    }

    /**
     * Update the price of the order item based on the current product price
     */
    public function recalculatePrices(int $totalOrderQuantity): void
    {
        $this->unit_price_net = $this->calcUnitPriceNet($totalOrderQuantity);
        $this->total_price_net = $this->calcTotalPriceNet($totalOrderQuantity);
        $this->save();
    }
}
