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
        Schema::create('alumno', function (Blueprint $table) {
            $table->string('nombre');
            $table->string('semestre');
            $table->string('carrera');
            $table->id('codigo_a');
            $table->string('codigo_c1');
            $table->foreign('codigo_c1')->references('codigo_c')->on('coordinador');
            $table->string('email_4');
            $table->foreign('email_4')->references('email')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno');
    }
};
