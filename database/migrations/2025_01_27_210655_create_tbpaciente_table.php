<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbpacienteTable extends Migration
{
    public function up()
    {
        Schema::create('tbpaciente', function (Blueprint $table) {
            $table->string('id_cedula', 10)->primary();
            $table->char('tipo_cedula', 4);
            $table->integer('id_empresa');
            $table->string('nombre', 300);
            $table->string('apellidos', 300)->nullable();
            $table->string('conocido_como', 300)->nullable();
            $table->string('telefono', 300)->nullable();
            $table->string('telefono_emergencia', 300)->nullable();
            $table->string('correo', 300)->nullable();
            $table->text('residencia')->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('estado');
            $table->foreign('id_empresa')->references('id_empresa')->on('tbempresa')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbpaciente');
    }
}