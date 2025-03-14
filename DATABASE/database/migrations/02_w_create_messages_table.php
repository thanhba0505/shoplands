<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->text('code')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('deleted_at')->nullable();
            $table->unsignedBigInteger('account_id');

            $table->foreign('account_id')->references('id')->on('accounts');
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
        });

        Schema::dropIfExists('messages');
    }
};
