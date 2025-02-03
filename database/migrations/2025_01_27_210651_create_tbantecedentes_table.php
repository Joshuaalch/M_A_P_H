<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbantecedentesTable extends Migration
{
    public function up()
    {
        Schema::create('tbantecedentes', function (Blueprint $table) {
            $table->integer('id_antecedente')->autoIncrement();
            $table->integer('id_empresa');
            $table->string('id_cedula', 300);
            $table->text('app')->nullable();
            $table->text('apf')->nullable();
            $table->text('aqx')->nullable();
            $table->text('tx')->nullable();
            $table->text('observaciones')->nullable();
            $table->foreign('id_empresa')->references('id_empresa')->on('tbempresa')->onDelete('cascade');
            $table->foreign('id_cedula')->references('id_cedula')->on('tbpaciente')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbantecedentes');
    }
}