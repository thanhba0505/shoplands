<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->enum('discount_type', ['percentage', 'fixed']);
            $table->decimal('discount_value', 15, 2);
            $table->decimal('maximum_discount', 15, 2)->nullable();
            $table->decimal('minimum_order_value', 15, 2)->nullable();
            $table->integer('usage_limit')->nullable();
            $table->integer('usage_count')->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('seller_id'); // Foreign key

            $table->foreign('seller_id')->references('id')->on('sellers');
        });
    }

    public function down(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropForeign(['seller_id']);
        });

        Schema::dropIfExists('coupons');
    }
};
