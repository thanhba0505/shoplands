<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variant_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_attribute_value_id');
            $table->unsignedBigInteger('product_variant_id');
            $table->timestamps();

            $table->foreign('product_attribute_value_id')->references('id')->on('product_attribute_values');
            $table->foreign('product_variant_id')->references('id')->on('product_variants');
        });
    }

    public function down(): void
    {
        Schema::table('product_variant_values', function (Blueprint $table) {
            $table->dropForeign(['product_attribute_value_id']);
            $table->dropForeign(['product_variant_id']);
        });

        Schema::dropIfExists('product_variant_values');
    }
};
