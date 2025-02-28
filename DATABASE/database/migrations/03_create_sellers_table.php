<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('store_name');
            $table->string('owner_name');
            $table->string('bank_name');
            $table->string('bank_number');
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->text('description')->nullable();
            $table->string('background')->nullable();
            $table->string('logo')->nullable();
            $table->unsignedBigInteger('account_id'); // Foreign key
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts');
        });
    }

    public function down(): void
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
        });

        Schema::dropIfExists('sellers');
    }
};
