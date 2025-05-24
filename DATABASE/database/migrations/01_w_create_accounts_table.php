<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->text('phone')->unique()->nullable();
            $table->text('phoneHash')->nullable();
            $table->text('bank_name')->nullable();
            $table->text('bank_number')->nullable();
            $table->text('password')->nullable();
            $table->text('google_id')->nullable();
            $table->string('email')->nullable();
            $table->enum('role', ['user', 'seller', 'admin']);
            $table->enum('status', ['active', 'inactive', 'locked', 'unverified']);
            $table->decimal('coin', 15, 2)->default(0);
            $table->text('device_token')->nullable();
            $table->text('access_token')->nullable();
            $table->text('refresh_token')->nullable();
            $table->dateTime('created_at');
        });
    }

    public function down(): void {
        Schema::dropIfExists('accounts');
    }
};
