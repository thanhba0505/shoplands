<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'payment_method',
        'cancel_reason',
        'from_address_id',
        'to_address_id',
        'user_id',
        'seller_id',
        'shipping_fee_id',
        'coupon_id',
    ];
}
