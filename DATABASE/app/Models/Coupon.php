<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'discount_value',
        'maximum_discount',
        'minimum_order_value',
        'usage_limit',
        'usage_count',
        'start_date',
        'end_date',
        'seller_id',
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
