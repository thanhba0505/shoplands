<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'price',
        'order_id',
        'product_variant_id',
    ];

    /**
     * Quan hệ với bảng Order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Quan hệ với bảng ProductVariant.
     */
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
