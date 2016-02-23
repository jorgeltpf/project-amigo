<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstablishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('cnpj', 14);
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('cell_phone');
            $table->string('cep');
            $table->string('neighborhood', 255);
            $table->string('street', 255);
            $table->integer('street_number');
            $table->string('complement', 255);
            $table->string('city', 255);
            $table->string('state', 50);
            $table->string('country', 50);
            $table->string('image', 255)->nullable();
            $table->integer('delivery_max_time')->nullable();
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
        });

        // Create table for associating establishments to people (Many-to-Many)
        Schema::create('establishment_person', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('establishment_id')->unsigned();
            $table->integer('person_id')->unsigned();
            $table->string('type', 50);

            $table->foreign('establishment_id')->references('id')->on('establishments')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('people')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['establishment_id', 'person_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('establishment_person');
        Schema::drop('establishments');
    }
}
