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
        Schema::create('docentes', function (Blueprint $table) {
            $table->string('nombre');
            $table->string('genero');
            $table->id('codigo_m');
            $table->string('codigo_c2');
            $table->foreign('codigo_c2')->references('codigo_c')->on('coordinadores');
            $table->unsignedBigInteger('id_3');
            $table->foreign('id_3')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docentes');
    }
};
