<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'review_id',
    ];
    public $timestamps = false;
    // Mối quan hệ với User
    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
