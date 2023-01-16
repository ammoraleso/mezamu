<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_dishes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('order_id');//foreign
            $table->unsignedBigInteger('dish_branch_id');//foreign
            $table->unsignedInteger('quantity');
            $table->boolean('delivered');
            $table->unsignedInteger('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_dishes');
    }
}
