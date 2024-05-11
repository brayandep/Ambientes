<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambientes', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo_ambiente_id');
            //$table->foreign('tipo_ambiente_id')->references('id')->on('tipo_ambientes');
            $table->string('codigo')->unique();
            $table->string('unidad'); 
            $table->string('nombre');
            $table->integer('capacidad'); 
            $table->string('ubicacion'); 
            $table->string('descripcion_ubicacion')->nullable();
            $table->boolean('estadoAmbiente'); 
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
        Schema::dropIfExists('ambientes');
    }
}
