<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAthletesTable extends Migration {

    public function up()
    {
        Schema::create('athletes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->enum('sex', ['m', 'f']);
            $table->date('dob');
            $table->unsignedSmallInteger('grad_year');
            $table->unsignedtinyInteger('fall_sport_id')->nullable();
            $table->unsignedtinyInteger('winter_sport_id')->nullable();
            $table->unsignedtinyInteger('spring_sport_id')->nullable();
            $table->enum('status', ['a', 'i']);
            $table->string('slug')->nullable();
            $table->timestamps();

            $table->foreign('fall_sport_id')->references('id')->on('fall_sports');
            $table->foreign('winter_sport_id')->references('id')->on('winter_sports');
            $table->foreign('spring_sport_id')->references('id')->on('spring_sports');


        });
    }

    public function down()
    {
        Schema::dropIfExists('athletes');
    }
}