<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticularsEstablishment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('particular_types', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('description', 50);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('particulars', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('description', 50);
            $table->integer('particular_type_id')->unsigned();
            $table->foreign('particular_type_id')->references('id')->on('particular_types');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('particulars_establishment', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('particular_id')->unsigned();
            $table->foreign('particular_id')->references('id')->on('particulars');
            $table->integer('establishment_id')->unsigned();
            $table->foreign('establishment_id')->references('id')->on('establishments');
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
        Schema::drop('particulars_establishment');
        Schema::drop('particulars');
        Schema::drop('particular_types');
    }
}
