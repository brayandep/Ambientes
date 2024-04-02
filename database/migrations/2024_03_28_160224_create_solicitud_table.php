<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud', function (Blueprint $table) {
            $table->id('idsolicitud');
          //  $table->unsignedBigInteger('id_usuario');
        //    $table->foreign('id_usuario')->references('id')->on('usuarios');
              $table->integer('usuario');
            $table->date('fecha');
            $table->string('motivo');
            $table->string('materia');
            $table->string('grupo');
            $table->string('nro_aula');
            $table->time('horario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud');
    }
}
