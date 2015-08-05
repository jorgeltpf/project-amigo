<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('people');
            $table->integer('establishment_id')->unsigned();
            $table->foreign('establishment_id')->references('id')->on('establishments');
            $table->integer('status');
            $table->decimal('total_amount', 8, 2);
            $table->string('street');
            $table->integer('street_number');
            $table->string('complement');
            $table->string('cep');
            $table->string('state');
            $table->string('country')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
