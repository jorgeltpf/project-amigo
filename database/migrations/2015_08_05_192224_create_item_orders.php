<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->decimal('amount', 8, 2);
            $table->decimal('total_amount', 8, 2);
            $table->integer('quantity');
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
        Schema::drop('item_orders');
    }
}
