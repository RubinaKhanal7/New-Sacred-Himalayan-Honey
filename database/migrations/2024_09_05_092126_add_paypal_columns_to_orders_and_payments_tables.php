<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaypalColumnsToOrdersAndPaymentsTables extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('paypal_order_id')->nullable()->after('order_status');
            $table->string('paypal_payer_id')->nullable()->after('paypal_order_id');
            $table->string('paypal_payment_id')->nullable()->after('paypal_payer_id');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->string('paypal_order_id')->nullable()->after('payment_status');
            $table->string('paypal_payer_id')->nullable()->after('paypal_order_id');
            $table->string('paypal_payment_id')->nullable()->after('paypal_payer_id');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('paypal_order_id');
            $table->dropColumn('paypal_payer_id');
            $table->dropColumn('paypal_payment_id');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('paypal_order_id');
            $table->dropColumn('paypal_payer_id');
            $table->dropColumn('paypal_payment_id');
        });
    }
}
