<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinterSportsTable extends Migration {

    public function up()
    {
        Schema::create('winter_sports', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('winter_sports');
    }
}