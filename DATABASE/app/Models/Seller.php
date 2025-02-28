<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = ['store_name', 'owner_name', 'bank_name', 'bank_number', 'status', 'description', 'background', 'logo', 'account_id'];

    // Mối quan hệ với bảng users
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    // Mối quan hệ với bảng addresses
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
