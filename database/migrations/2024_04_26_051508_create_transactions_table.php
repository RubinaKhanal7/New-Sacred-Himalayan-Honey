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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->foreign('user_id')->references('id')->on('customers');
        $table->unsignedBigInteger('order_id');
        $table->foreign('order_id')->references('id')->on('orders');
        $table->decimal('amount', 10, 2);
        $table->dateTime('transaction_date');
        $table->unsignedBigInteger('payment_id'); // Corrected column name
        $table->foreign('payment_id')->references('id')->on('payments'); // Corrected reference to 'payments' table
        $table->string('status')->nullable();
        $table->timestamps();
    });
}

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
