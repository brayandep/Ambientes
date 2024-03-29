<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioDisponiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario_disponibles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ambientes');
            $table->foreign('id_ambientes')->references('id')->on('ambientes');
            $table->time('horaInicio'); 
            $table->time('horaFin');
            $table->boolean('estadoHorario'); 
            $table->date('dia'); 
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
        Schema::dropIfExists('horario_disponibles');
    }
}