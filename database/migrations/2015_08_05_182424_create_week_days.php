<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeekDays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('week_days', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('establishment_week_day', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('week_day_id')->unsigned();
            $table->integer('establishment_id')->unsigned();
            $table->integer('shift')->unsigned();
            $table->time('time_on');
            $table->time('time_off');
            // $table->timestamps();

            $table->foreign('week_day_id')->references('id')->on('week_days')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('establishment_id')->references('id')->on('establishments')
                ->onUpdate('cascade')->onDelete('cascade');

            //$table->primary(['week_day_id', 'establishment_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('establishment_week_day');
        Schema::drop('week_days');
    }
}
