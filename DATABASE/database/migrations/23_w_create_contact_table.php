<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->text('phone')->unique();
            $table->text('phoneHash');
            $table->text('name');
            $table->text('topic');
            $table->text('content');
            $table->text('response')->nullable();
            $table->dateTime('created_at');
        });
    }

    public function down(): void {
        Schema::dropIfExists('contact');
    }
};
