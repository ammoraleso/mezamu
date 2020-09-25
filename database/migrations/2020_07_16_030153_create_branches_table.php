<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('location', 32);
            $table->unsignedBigInteger('restaurant_id');//foreign
            $table->unsignedInteger('tables');
            $table->String('telefono', 15);
            $table->boolean('disable_epay')->default(0);
            $table->string('email');
            $table->float('latitude','8','6');
            $table->float('longitude','8','6');
            $table->boolean('delivery_price_type');//0 fixed; 1 per meter
            $table->unsignedInteger('delivery_price');
            $table->unsignedInteger('coverage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
