<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_address', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('description');
            $table->string('phone');
            $table->string('cell_phone');
            $table->string('cep');
            $table->string('street', 255);
            $table->string('neighborhood', 255);
            $table->integer('street_number');
            $table->string('complement', 255);
            $table->string('city', 255);
            $table->string('state', 50);
            $table->string('country', 50);
            $table->boolean('favorite');
            $table->integer('user_id')->unsigned()->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::drop('my_address');
    }
}
