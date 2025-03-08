<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'product_id',
    ];
    public $timestamps = false;
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
