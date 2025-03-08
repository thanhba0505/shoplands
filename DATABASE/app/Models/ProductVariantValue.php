<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantValue extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'product_attribute_value_id',
        'product_variant_id'
    ];

    public function product()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function productAttributeValue()
    {
        return $this->belongsTo(ProductAttributeValue::class);
    }
}
