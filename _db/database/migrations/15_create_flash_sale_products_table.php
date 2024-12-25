<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flash_sale_products', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 15, 2);
            $table->integer('quantity');
            $table->integer('sold_quantity');
            $table->date('date');
            $table->unsignedBigInteger('product_variant_id'); // Foreign key
            $table->unsignedBigInteger('flash_sale_time_id'); // Foreign key
            $table->timestamps();

            $table->foreign('product_variant_id')->references('id')->on('product_variants');
            $table->foreign('flash_sale_time_id')->references('id')->on('flash_sale_times');
        });
    }

    public function down(): void
    {
        Schema::table('flash_sale_products', function (Blueprint $table) {
            $table->dropForeign(['product_variant_id']);
            $table->dropForeign(['flash_sale_time_id']);
        });

        Schema::dropIfExists('flash_sale_products');
    }
};
