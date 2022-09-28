<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_agendas', function (Blueprint $table) {
            $table->string('nrc');
            $table->unsignedBigInteger('id_students');
            $table->foreign('id_students')->references('id')->on('students');
            $table->unsignedBigInteger('id_subjects');
            $table->foreign('id_subjects')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_agendas');
    }
};
