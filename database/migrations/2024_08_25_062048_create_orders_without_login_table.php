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
        Schema::create('orders_without_login', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('user_email');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Foreign key to products
            $table->integer('quantity');
            $table->decimal('total_amount', 10, 2);
            $table->text('shipping_address');
            $table->string('shipping_country');
            $table->string('postal_code')->nullable();
            $table->string('payment_method');
            $table->enum('payment_status', ['pending', 'completed', 'cancelled']);
            $table->enum('order_status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled']);
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_shipped')->default(false);
            $table->boolean('is_delivered')->default(false);
            $table->dateTime('order_date')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('orders_without_login');
    }
};
