<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSaleTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'time_start',
        'time_end',
    ];
}
