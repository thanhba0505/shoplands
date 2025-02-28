<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['phone', 'password', 'role', 'status', 'time_start', 'access_token', 'refresh_token'];
}
