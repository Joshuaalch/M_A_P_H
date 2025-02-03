<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbusuarioTable extends Migration
{
    public function up()
    {
        Schema::create('tbusuario', function (Blueprint $table) {
            $table->string('id_cedula', 300)->primary();
            $table->char('tipo_cedula', 4);
            $table->integer('id_empresa');
            $table->string('nombre', 300);
            $table->string('apellidos', 300);
            $table->string('telefono', 300);
            $table->string('correo', 300);
            $table->string('contrasena', 400);
            $table->char('rol', 4);
            $table->boolean('estado');
            $table->foreign('id_empresa')->references('id_empresa')->on('tbempresa')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbusuario');
    }
}