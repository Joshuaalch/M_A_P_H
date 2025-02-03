<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateTbcitaTable extends Migration
{
    public function up()
    {
        Schema::create('tbcita', function (Blueprint $table) {
            $table->integer('id_cita')->autoIncrement();
            $table->integer('id_empresa');
            $table->string('id_cedula_usuario', 300);
            $table->string('id_cedula_paciente', 300);
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_final');
            $table->foreign('id_empresa')->references('id_empresa')->on('tbempresa')->onDelete('cascade');
            $table->foreign('id_cedula_usuario')->references('id_cedula')->on('tbusuario')->onDelete('cascade');
            $table->foreign('id_cedula_paciente')->references('id_cedula')->on('tbpaciente')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbcita');
    }
}