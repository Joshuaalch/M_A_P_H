<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbempresaTable extends Migration
{
    public function up()
    {
        Schema::create('tbempresa', function (Blueprint $table) {
            $table->integer('id_empresa')->autoIncrement();
            $table->string('nombre', 300);
            $table->string('cedula', 300);
            $table->char('tipo_cedula', 4);
            $table->string('telefono', 300);
            $table->string('correo', 10000);
            $table->boolean('estado');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbempresa');
    }
}