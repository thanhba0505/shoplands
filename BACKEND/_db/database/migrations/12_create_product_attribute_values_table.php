<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->unsignedBigInteger('product_attribute_id'); // Foreign key
            $table->timestamps();

            $table->foreign('product_attribute_id')->references('id')->on('product_attributes');
        });
    }

    public function down(): void
    {
        Schema::table('product_attribute_values', function (Blueprint $table) {
            $table->dropForeign(['product_attribute_id']);
        });

        Schema::dropIfExists('product_attribute_values');
    }
};