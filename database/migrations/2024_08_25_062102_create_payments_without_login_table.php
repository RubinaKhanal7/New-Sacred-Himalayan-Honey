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
        Schema::create('payments_without_login', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders_without_login')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Foreign key to products
            $table->decimal('amount', 10, 2);
            $table->string('payment_method');
            $table->string('payment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments_without_login');
    }
};
