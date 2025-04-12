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
            $table->string('province_id');
            $table->string('province_name');
            $table->string('district_id');
            $table->string('district_name');
            $table->string('ward_id');
            $table->string('ward_name');
            $table->unsignedBigInteger('account_id')->nullable(); // Foreign key

            $table->foreign('account_id')->references('id')->on('accounts');
        });
    }

    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
        });

        Schema::dropIfExists('addresses');
    }
};
