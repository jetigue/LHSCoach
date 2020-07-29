<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhysicalsTable extends Migration {

    public function up()
    {
        Schema::create('physicals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('athlete_id');
            $table->boolean('history_form')->default(0);
            $table->boolean('physical_exam_form')->default(0);
            $table->boolean('medical_eligibility_form')->default(0);
            $table->boolean('physical_form')->default(0);
            $table->boolean('transportation_waiver_form')->default(0);
            $table->boolean('ghsa_concussion_form')->default(0);
            $table->boolean('ghsa_cardiac_form')->default(0);
            $table->date('exam_date');
            $table->string('restrictions')->nullable();
            $table->text('notes')->nullable();
            $table->string('form_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('physicals');
    }
}