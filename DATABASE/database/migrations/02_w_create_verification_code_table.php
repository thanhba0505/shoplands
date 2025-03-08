<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('verification_codes', function (Blueprint $table) {
            $table->id();
            $table->string('message_sid');
            $table->string('code');
            $table->dateTime('created_date_time');
            $table->string('phone');
            $table->timestamps();
        });
    }

    public function down(): void
    {

        Schema::dropIfExists('verification_codes');
    }
};
