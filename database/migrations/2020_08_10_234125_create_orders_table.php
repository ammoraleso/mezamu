<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('branch_id');//foreign
            $table->string('type');
            $table->string('payment_type');
            $table->unsignedBigInteger('customer_id')->nullable();//foreign
            $table->string('place');
            $table->unsignedInteger('status')->default(0);//0 new; 1 preparing; 2 Ready
            $table->unsignedInteger('total');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
