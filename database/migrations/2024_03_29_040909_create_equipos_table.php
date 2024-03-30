<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo_ambiente_id');
            //$table->foreign('tipo_ambiente_id')->references('id')->on('tipo_ambientes');
            $table->integer('ambiente_id')->nullable();
            //$table->foreign('ambiente_id')->references('id')->on('ambientes');
            $table->string('nombreEquipo');
            $table->boolean('estadoEquipo'); 
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
        Schema::dropIfExists('equipos');
    }
}
