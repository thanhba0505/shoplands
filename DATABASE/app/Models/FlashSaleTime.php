<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSaleTime extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'description',
        'time_start',
        'time_end',
    ];
}
