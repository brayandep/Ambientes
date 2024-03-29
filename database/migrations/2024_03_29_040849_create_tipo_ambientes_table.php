<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoAmbientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_ambientes', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('id_ambientes');
            //$table->foreign('id_ambientes')->references('id')->on('ambientes');
            $table->string('nombreTipo'); 
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
        Schema::dropIfExists('tipo_ambientes');
    }
}
