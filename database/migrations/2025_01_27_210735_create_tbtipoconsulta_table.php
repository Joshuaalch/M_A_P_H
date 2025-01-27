<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbtipoconsultaTable extends Migration
{
    public function up()
    {
        Schema::create('tbtipoconsulta', function (Blueprint $table) {
            $table->integer('id_tipoconsulta')->autoIncrement();
            $table->string('nombre', 300);
            $table->integer('id_empresa');
            $table->foreign('id_empresa')->references('id_empresa')->on('tbempresa')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbtipoconsulta');
    }
}