<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address_line');
            $table->boolean('default')->default(false);
            $table->unsignedBigInteger('province_id'); // Foreign key
            $table->unsignedBigInteger('seller_id')->nullable(); // Foreign key
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign key
            $table->timestamps();

            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['province_id']);
            $table->dropForeign(['seller_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('addresses');
    }
};
