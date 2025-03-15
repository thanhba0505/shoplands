<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'subtotal_price',
        'discount',
        'final_price',
        'cancel_reason',
        'from_address_id',
        'to_address_id',
        'user_id',
        'seller_id',
        'shipping_fee_id',
        'coupon_id',
    ];

    /**
     * Quan hệ với bảng OrderItem.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Quan hệ với bảng User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Quan hệ với bảng Seller.
     */
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    /**
     * Quan hệ với bảng Address (from_address).
     */
    public function fromAddress()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Quan hệ với bảng Address (to_address).
     */
    public function toAddress()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Quan hệ với bảng ShippingFee.
     */
    public function shippingFee()
    {
        return $this->belongsTo(ShippingFee::class);
    }

    /**
     * Quan hệ với bảng Coupon.
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
