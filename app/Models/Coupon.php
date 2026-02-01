<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'code', 'amount', 'type', 'expired_date', 'min_purchase', 'max_value'
    ];

    // Accessor to check if the coupon is expired
    public function getIsExpiredAttribute()
    {
        return $this->expired_date < now();
    }
    // Check if the coupon is expired
    public function isExpired()
    {
        return Carbon::today()->gt($this->expired_date);
    }

    // Calculate the discount amount
    public function calculateDiscount($subtotal)
    {
        if ($subtotal < $this->min_purchase) {
            return 0; // If subtotal is less than minimum purchase, no discount
        }

        $discount = 0;
        if ($this->type == 'fixed') {
            $discount = $this->amount;
        } elseif ($this->type == 'percent') {
            $discount = ($subtotal * $this->amount) / 100;
        }

        // Apply max value restriction
        if ($this->max_value && $discount > $this->max_value) {
            $discount = $this->max_value;
        }

        return $discount;
    }
}
