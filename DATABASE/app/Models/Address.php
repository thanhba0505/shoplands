<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'address_line',
        'default',
        'province_id',
        'province_name',
        'district_id',
        'district_name',
        'ward_id',
        'ward_name',
        'account_id',
    ];

    // Mối quan hệ với Seller
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    // Mối quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
