<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('customers');
            $table->dateTime('order_date');
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_method');
            $table->enum('payment_status', ['pending', 'completed', 'cancelled']);
            $table->text('shipping_address');
            $table->string('shipping_country');
            $table->string('postal_code')->nullable();
            $table->decimal('shipping_cost', 10, 2);
            $table->decimal('tax_amount', 10, 2);
            $table->enum('order_status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled']);
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_shipped')->default(false);
            $table->boolean('is_delivered')->default(false);
            $table->dateTime('delivery_date')->nullable();
            $table->time('delivery_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
