<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_history', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 15, 2);
            $table->enum('status', ['request', 'sent', 'completed']);
            $table->string('content')->nullable();
            $table->dateTime('created_at');
            $table->unsignedBigInteger('account_id'); // Foreign key

            $table->foreign('account_id')->references('id')->on('accounts');
        });
    }

    public function down(): void
    {
        Schema::table('payment_history', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
        });

        Schema::dropIfExists('payment_history');
    }
};
