<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->boolean('default')->default(false);
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');

            // Ràng buộc unique chỉ áp dụng khi default = true
            // $table->unique(['product_id', 'default'], 'unique_default_image_per_product');
        });
    }

    public function down(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropUnique('unique_default_image_per_product');
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('product_images');
    }
};
