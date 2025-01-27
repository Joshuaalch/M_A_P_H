<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbtipousuarioTable extends Migration
{
    public function up()
    {
        Schema::create('tbtipousuario', function (Blueprint $table) {
            $table->integer('id_tipo')->autoIncrement();
            $table->string('nombre', 300);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbtipousuario');
    }
}