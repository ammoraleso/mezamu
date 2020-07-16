<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
        });

        Schema::table('dish_branch', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('dish_id')->references('id')->on('dishes');
        });

        Schema::table('dishes', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::table('tag_dish', function (Blueprint $table) {
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('dish_id')->references('id')->on('dishes');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropForeign(['restaurant_id']);
            $table->dropColumn('restaurant_id');
        });

        Schema::table('dish_branch', function (Blueprint $table) {
            $table->dropForeign('branch_id');
            $table->dropColumn('branch_id');
            $table->dropForeign('dish_id');
            $table->dropColumn('dish_id');
        });

        Schema::table('dishes', function (Blueprint $table) {
            $table->dropForeign('category_id');
            $table->dropColumn('category_id');
        });

        Schema::table('tag_dish', function (Blueprint $table) {
            $table->dropForeign('tag_id');
            $table->dropColumn('tag_id');
            $table->dropForeign('dish_id');
            $table->dropColumn('dish_id');
        });

    }
}
