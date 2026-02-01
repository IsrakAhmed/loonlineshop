<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Unique coupon code
            $table->decimal('amount', 10, 2); // Discount amount
            $table->enum('type', ['percent', 'fixed']); // Discount type (percent/fixed)
            $table->date('expired_date'); // Expiration date of the coupon
            $table->decimal('min_purchase', 10, 2)->default(0); // Minimum purchase to apply the coupon
            $table->decimal('max_value', 10, 2)->nullable(); // Maximum discount value
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
};
