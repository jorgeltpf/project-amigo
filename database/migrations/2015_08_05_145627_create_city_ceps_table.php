<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityCepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_ceps', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('cep');
            $table->string('city');
            $table->string('country')->nullable();
            $table->timestamps();
        });

        Schema::create('cep_establishment', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->integer('cep_id')->unsigned();
            $table->integer('establishment_id')->unsigned();
            $table->decimal('delivery_tax')->nullable();
            $table->datetime('estimated_time')->nullable();

            $table->foreign('cep_id')->references('id')->on('city_ceps')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('establishment_id')->references('id')->on('establishments')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['cep_id', 'establishment_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cep_establishment');
        Schema::drop('city_ceps');
    }
}
