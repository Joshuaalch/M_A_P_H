<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbconsultaTable extends Migration
{
    public function up()
    {
        Schema::create('tbconsulta', function (Blueprint $table) {
            $table->integer('id_consulta')->autoIncrement();
            $table->string('id_cedula', 300);
            $table->integer('id_empresa');
            $table->string('tipoconsulta', 300);
            $table->text('valoracion')->nullable();
            $table->string('presion_arterial', 300)->nullable();
            $table->string('frecuencia_cardiaca', 300)->nullable();
            $table->string('saturacion_oxigeno', 300)->nullable();
            $table->string('glicemia', 300)->nullable();
            $table->string('frecuencia_respiratoria', 300)->nullable();
            $table->text('plan_tratamiento')->nullable();
            $table->date('fecha_consulta');
            $table->decimal('monto_consulta', 10, 2)->nullable();
            $table->boolean('estado');
            $table->foreign('id_cedula')->references('id_cedula')->on('tbpaciente')->onDelete('cascade');
            $table->foreign('id_empresa')->references('id_empresa')->on('tbempresa')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbconsulta');
    }
}