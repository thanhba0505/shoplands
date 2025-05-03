<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('giaohangnhanh', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();

            // From (sender)
            $table->string('from_name');
            $table->string('from_phone');
            $table->string('from_address');
            $table->string('from_ward_name');
            $table->string('from_district_name');
            $table->string('from_province_name');

            // To (receiver)
            $table->string('to_name');
            $table->string('to_phone');
            $table->string('to_address');
            $table->string('to_ward_name');
            $table->string('to_district_name');
            $table->string('to_province_name');

            // Date
            $table->dateTime('created_at');
            $table->dateTime('from_estimate_date');
            $table->dateTime('to_estimate_date');
        });
    }

    public function down(): void {
        Schema::dropIfExists('giaohangnhanh');
    }
};
