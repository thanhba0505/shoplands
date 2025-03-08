<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSaleProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'quantity',
        'sold_quantity',
        'date',
        'product_variant_id',
        'flash_sale_time_id',
    ];
    public $timestamps = false;
    // Mối quan hệ với ProductVariant
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    // Mối quan hệ với FlashSaleTime
    public function flashSaleTime()
    {
        return $this->belongsTo(FlashSaleTime::class);
    }
}
