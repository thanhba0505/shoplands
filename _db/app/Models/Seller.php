<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'background', 'logo', 'user_id'];

    // Mối quan hệ với bảng users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mối quan hệ với bảng addresses
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
