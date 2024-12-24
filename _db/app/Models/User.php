<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['phone', 'password', 'name', 'email', 'avatar'];

    // Nếu cần mã hóa mật khẩu
    protected static function booted()
    {
        static::creating(function ($user) {
            if ($user->password) {
                $user->password = bcrypt($user->password); // Mã hóa mật khẩu
            }
        });
    }
}
