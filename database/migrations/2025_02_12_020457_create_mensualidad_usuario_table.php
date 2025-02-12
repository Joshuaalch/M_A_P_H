<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('mensualidad_usuario', function (Blueprint $table) {
            $table->id('id_mensualidad'); // Auto Increment Primary Key
            $table->string('id_cedula', 300);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->tinyInteger('estado')->default(1); // 1 = Activo, 0 = Inactivo
            $table->foreign('id_cedula')->references('id_cedula')->on('tbusuario')->onDelete('cascade')->onUpdate('cascade');
          
        });
    }

    public function down()
    {
        Schema::dropIfExists('mensualidad_usuario');
    }
};
