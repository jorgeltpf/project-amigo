<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('people', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->smallInteger('people_type');
            $table->string('cpf', 11)->unique();
            $table->string('email')->unique();
            $table->string('phone')->nullable()->default(null);
            $table->string('cell_phone')->nullable()->default(null);
            $table->string('cep')->nullable()->default(null);
            $table->string('street', 255)->nullable()->default(null);
            $table->string('neighborhood', 255)->nullable()->default(null);
            $table->integer('street_number')->nullable()->default(null);
            $table->string('complement', 255)->nullable()->default(null);
            $table->string('city', 255)->nullable()->default(null);
            $table->string('state', 50)->nullable()->default(null);
            $table->string('country', 50)->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('people');
            $table->string('name');
            $table->string('username')->unique(); // used for slug.
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('confirmation_code');
            $table->string('avatar')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->boolean('admin')->default(false);
            $table->rememberToken(255);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
        Schema::drop('people');
    }

}
