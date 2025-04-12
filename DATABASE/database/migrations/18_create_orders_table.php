<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('subtotal_price', 15, 2);
            $table->decimal('shipping_fee', 15, 2);
            $table->decimal('discount', 15, 2)->default(0);
            $table->decimal('final_price', 15, 2);
            $table->decimal('revenue', 15, 2);
            $table->boolean('paid')->default(false);
            $table->string('vnp_txnref')->nullable()->index();
            $table->text('vnp_url')->nullable();
            $table->string('ghn_order_code')->nullable();
            $table->string('ghn_status')->nullable();
            $table->unsignedBigInteger('from_address_id'); // Foreign key
            $table->unsignedBigInteger('to_address_id'); // Foreign key
            $table->unsignedBigInteger('user_id'); // Foreign key
            $table->unsignedBigInteger('seller_id'); // Foreign key
            $table->unsignedBigInteger('coupon_id')->nullable(); // Foreign key
            $table->dateTime('created_at');

            $table->foreign('from_address_id')->references('id')->on('addresses');
            $table->foreign('to_address_id')->references('id')->on('addresses');
            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->foreign('coupon_id')->references('id')->on('coupons');
            $table->foreign('user_id')->references('id')->on('users');
        });

        DB::statement('ALTER TABLE orders AUTO_INCREMENT = 123456;');
    }

    public function down(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['from_address_id']);
            $table->dropForeign(['to_address_id']);
            $table->dropForeign(['seller_id']);
            $table->dropForeign(['coupon_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('orders');
    }
};
