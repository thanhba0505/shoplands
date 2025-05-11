<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('rating')->nullable();
            $table->text('comment');
            $table->unsignedBigInteger('user_id'); // Foreign key
            $table->unsignedBigInteger('product_variant_id');  // Foreign key
            $table->unsignedBigInteger('order_id');  // Foreign key
            $table->dateTime('created_at');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_variant_id')->references('id')->on('product_variants');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['product_variant_id']);
            $table->dropForeign(['order_id']);
        });

        Schema::dropIfExists('reviews');
    }
};
