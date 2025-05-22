<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'locked', 'deleted']);
            $table->text('qrcode')->nullable();
            $table->unsignedBigInteger('seller_id'); // Foreign key
            $table->unsignedBigInteger('category_id')->nullable(); // Foreign key

            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['seller_id']);
            $table->dropForeign(['category_id']);
        });

        Schema::dropIfExists('products');
    }
};
