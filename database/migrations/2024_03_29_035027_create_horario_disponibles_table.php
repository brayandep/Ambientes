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
            $table->integer('ambiente_id');
            //$table->foreign('ambiente_id')->references('id')->on('ambientes');
            $table->string('horaInicio'); 
            $table->string('horaFin');
            $table->boolean('estadoHorario'); 
            $table->string('dia'); 
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
