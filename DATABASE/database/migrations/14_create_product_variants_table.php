<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 15, 2);
            $table->decimal('promotion_price', 15, 2)->nullable();
            $table->integer('quantity');
            $table->integer('sold_quantity');
            $table->unsignedBigInteger('product_id'); // Foreign key

            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    public function down(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('product_variants');
    }
};
