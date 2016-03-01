<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->integer('establishment_id');
            $table->foreign('establishment_id')->references('id')->on('establishments');
            $table->date('initial_period');
            $table->date('final_period');
            $table->decimal('discount', 8, 2);
            $table->timestamps();
        });

        Schema::create('product_promotion', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('promotion_id');
            $table->foreign('promotion_id')->references('id')->on('promotions');
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_promotion');
        Schema::drop('promotions');
    }
}
