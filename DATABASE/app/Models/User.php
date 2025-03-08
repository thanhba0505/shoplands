<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'avatar', 'account_id'];

    // Nếu cần mã hóa mật khẩu
    // protected static function booted()
    // {
    //     static::creating(function ($user) {
    //         if ($user->password) {
    //             $user->password = bcrypt($user->password); // Mã hóa mật khẩu
    //         }
    //     });
    // }
    // Mối quan hệ với bảng users
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
