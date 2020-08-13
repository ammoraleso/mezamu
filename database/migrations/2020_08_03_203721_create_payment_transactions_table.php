<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('ref_payco');
            $table->integer('response_code');
            $table->string('response_reason');
            $table->longText('data');
            $table->longText('cart');
            $table->string('delivery_name');
            $table->integer('city');
            $table->string('address');
            $table->unsignedInteger('status')->nullable();//0 campaign cancelled ,1 payed, 2 pending delivery, 3 sent, 4 delivered. No need for pending transaction status (null) because those transactions are stored in pending_transactions tables
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
        Schema::dropIfExists('payment_transactions');
    }
}
