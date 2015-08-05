<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('cell_phone');
            $table->string('street', 255);
            $table->integer('street_number');
            $table->string('complement', 255);
            $table->string('city', 255);
            $table->string('state', 50);
            $table->string('country', 50);
            $table->string('cep');
            $table->string('cpf', 11);
            $table->smallInteger('people_type');
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
        Schema::drop('people');
    }
}
