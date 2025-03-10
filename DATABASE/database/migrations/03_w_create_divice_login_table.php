<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('device_login', function (Blueprint $table) {
            $table->id();
            $table->text('device_token')->nullable();
            $table->text('code');
            $table->text('message_sid');
            $table->dateTime('created_at');
            $table->unsignedBigInteger('account_id')->unique(); // Foreign key

            $table->foreign('account_id')->references('id')->on('accounts');
        });
    }

    public function down(): void
    {
        Schema::table('device_login', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
        });

        Schema::dropIfExists('device_login');
    }
};
