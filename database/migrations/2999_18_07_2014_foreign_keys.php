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

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->foreign('branch_id')->references('id')->on('branches');
        });

        Schema::table('order_dishes', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders');;
            $table->foreign('dish_branch_id')->references('id')->on('dish_branch');;
        });

        Schema::table('schedule_branch', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('branches');
        });

        Schema::table('tag_dish', function (Blueprint $table) {
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('dish_id')->references('id')->on('dishes');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('branches');
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

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('customer_id');
            $table->dropColumn('customer_id');
            $table->dropForeign('branch_id');
            $table->dropColumn('branch_id');
        });

        Schema::table('order_dishes', function (Blueprint $table) {
            $table->dropForeign('order_id');
            $table->dropColumn('order_id');
            $table->dropForeign('dish_branch_id');
            $table->dropColumn('dish_branch_id');
        });

        Schema::table('schedule_branch', function (Blueprint $table) {
            $table->dropForeign('branch_id');
            $table->dropColumn('branch_id');
        });

        Schema::table('tag_dish', function (Blueprint $table) {
            $table->dropForeign('tag_id');
            $table->dropColumn('tag_id');
            $table->dropForeign('dish_id');
            $table->dropColumn('dish_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('branch_id');
            $table->dropColumn('branch_id');
        });

    }
}
