<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_type', function (Blueprint $table) {
            $table->id()->unique();
            $table->unsignedBigInteger('branch_id')->unique();//foreign
            $table->boolean('online')->default(0);
            $table->string('online_description', 45);
            $table->boolean('checkout')->default(0);
            $table->string('checkout_description', 45);
            $table->boolean('efectivo')->default(0);
            $table->string('efectivo_description', 45);
            $table->boolean('datafono')->default(0);
            $table->string('datafono_description', 45);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule');
    }
}
