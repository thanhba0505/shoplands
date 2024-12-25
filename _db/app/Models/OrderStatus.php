<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'order_status';

    protected $fillable = [
        'status',
        'date_time',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
