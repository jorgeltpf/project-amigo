<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeOpenClosed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_open_closed', function (Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('week_day_id')->unsigned();
            $table->foreign('week_day_id')->references('id')->on('week_days');
            $table->time('time_open');
            $table->time('time_closed');
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
        Schema::drop('time_open_closed');
    }
}
