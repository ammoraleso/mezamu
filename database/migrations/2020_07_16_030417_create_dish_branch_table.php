<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_branch', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('branch_id');//foreign
            $table->unsignedBigInteger('dish_id');//foreign
            $table->boolean('promotion')->default(0);
            $table->float('promotion_percentage')->nullable();
            $table->unsignedInteger('promotion_price')->nullable();//We use this field when we wanna give a price instead of a percentage of discount
            $table->boolean('disable')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dish_branch');
    }
}
