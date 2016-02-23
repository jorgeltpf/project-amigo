<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_classes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('product_species', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('product_types', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('product_specie_id')->unsigned()->nullable();
            $table->foreign('product_specie_id')->references('id')->on('product_species');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('product_type_id')->unsigned();
            $table->foreign('product_type_id')->references('id')->on('product_types');            
            $table->integer('product_class_id')->unsigned();
            $table->foreign('product_class_id')->references('id')->on('product_classes');
            $table->string('name');
            $table->string('description');
            $table->decimal('price', 8, 2);
            $table->string('image', 255)->nullable();
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
        Schema::drop('products');
        Schema::drop('product_types');
        Schema::drop('product_classes');
        Schema::drop('product_species');
    }
}
