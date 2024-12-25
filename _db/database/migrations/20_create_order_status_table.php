<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_status', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['pending', 'packing', 'packed', 'shipping', 'delivered', 'cancelled', 'returned', 'completed']);
            $table->dateTime('date_time');
            $table->unsignedBigInteger('order_id');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    public function down(): void
    {
        Schema::table('order_status', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
        });

        Schema::dropIfExists('order_status');
    }
};