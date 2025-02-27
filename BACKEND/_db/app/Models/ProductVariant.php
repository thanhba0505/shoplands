<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'promotion_price',
        'quantity',
        'sold_quantity',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
