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
            $table->string('phone')->unique();
            $table->string('password');
            $table->enum('role', ['user', 'seller', 'admin']);
            $table->enum('status', ['active', 'inactive', 'banned']);
            $table->string('access_token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->dateTime('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
