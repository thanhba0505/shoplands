<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->string('vnp_code');
            $table->text('vnp_message');
            $table->text('vnp_json');
            $table->string('vnp_txnref')->unique(); // Foreign key, kiểu string để phù hợp với kiểu trong bảng orders

            $table->foreign('vnp_txnref')->references('vnp_txnref')->on('orders');
        });
    }

    public function down(): void {
        Schema::table('order_payments', function (Blueprint $table) {
            $table->dropForeign(['vnp_txnref']);
        });

        Schema::dropIfExists('order_payments');
    }
};
