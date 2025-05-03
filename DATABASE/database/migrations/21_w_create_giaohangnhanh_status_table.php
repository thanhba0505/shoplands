<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('giaohangnhanh_status', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->string('status');
            $table->string('message');
            $table->dateTime('created_at');

            $table->foreign('order_code')->references('order_code')->on('giaohangnhanh');
        });
    }

    public function down(): void {
        Schema::table('giaohangnhanh_status', function (Blueprint $table) {
            $table->dropForeign(['order_code']);
        });

        Schema::dropIfExists('giaohangnhanh_status');
    }
};
