<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['phone', 'phoneHash', 'password', 'role', 'status', 'created_at', 'access_token', 'refresh_token'];
    public $timestamps = false;
}
