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
            $table->integer('codigo')->unique(); // Código
            $table->string('unidad'); // Unidad
            $table->string('nombre'); // Nombre
            $table->integer('capacidad'); // Capacidad (asumo que es un número entero)
            $table->string('ubicacion'); // Ubicación
            $table->string('descripcion_ubicacion')->nullable();
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
