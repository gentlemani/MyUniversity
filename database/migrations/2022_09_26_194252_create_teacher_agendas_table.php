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
        Schema::create('teacher_agendas', function (Blueprint $table) {
            $table->string('nrc');
            $table->unsignedBigInteger('id_teachers');
            $table->foreign('id_teachers')->references('id')->on('teachers');
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
        Schema::dropIfExists('teacher_agendas');
    }
};
