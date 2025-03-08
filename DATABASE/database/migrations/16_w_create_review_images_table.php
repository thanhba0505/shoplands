<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('review_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->unsignedBigInteger('review_id'); // Foreign key

            $table->foreign('review_id')->references('id')->on('reviews');
        });
    }

    public function down(): void
    {
        Schema::table('review_images', function (Blueprint $table) {
            $table->dropForeign(['review_id']);
        });

        Schema::dropIfExists('review_images');
    }
};
