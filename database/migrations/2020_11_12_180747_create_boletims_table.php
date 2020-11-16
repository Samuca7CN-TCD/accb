<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mes_id');
            $table->integer('ano');
            $table->integer('numero_paginas');
            $table->integer('numero_visualizacoes');
            $table->binary('boletim');
            $table->string('tipo_boletim');
            $table->string('titulo_boletim');
            $table->foreign('mes_id')->references('id')->on('meses');
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
        Schema::dropIfExists('boletins');
    }
}
