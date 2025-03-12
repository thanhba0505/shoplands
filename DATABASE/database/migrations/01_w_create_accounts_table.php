<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->text('phone')->unique();
            $table->text('phoneHash');
            $table->text('password');
            $table->enum('role', ['user', 'seller', 'admin']);
            $table->enum('status', ['active', 'inactive', 'banned']);
            $table->text('device_token')->nullable();
            $table->text('access_token')->nullable();
            $table->text('refresh_token')->nullable();
            $table->dateTime('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
