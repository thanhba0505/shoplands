<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'comment',
        'created_at',
        'user_id',
        'product_variant_id',
    ];
    public $timestamps = false;
    // Mối quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mối quan hệ với ProductVariant
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
