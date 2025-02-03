<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbregistrosTable extends Migration
{
    public function up()
    {
        Schema::create('tbregistros', function (Blueprint $table) {
            $table->integer('id_registro')->autoIncrement();
            $table->integer('id_empresa');
            $table->string('id_cedula', 300);
            $table->date('fecha');
            $table->binary('img1')->nullable();
            $table->binary('img2')->nullable();
            $table->binary('img3')->nullable();
            $table->binary('pdf')->nullable();
            $table->text('detalle');
            $table->foreign('id_empresa')->references('id_empresa')->on('tbempresa')->onDelete('cascade');
            $table->foreign('id_cedula')->references('id_cedula')->on('tbpaciente')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbregistros');
    }
}