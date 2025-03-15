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
            $table->unsignedBigInteger('account_id')->nullable(); // Foreign key

            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('account_id')->references('id')->on('accounts');
        });
    }

    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['province_id']);
            $table->dropForeign(['account_id']);
        });

        Schema::dropIfExists('addresses');
    }
};
