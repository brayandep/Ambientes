<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
<<<<<<< HEAD
    {   /**es unidads porque como el modelo se llama Unidad,los proximos registros solo aumentara una s y serian unidads*/
=======
    {  
>>>>>>> brayan2
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('nombreUnidad');
            $table->integer('codigoUnidad');
            $table->string('Responsable');
            $table->integer('Nivel');
            $table->integer('Dependencia');
            $table->integer('UnidadHabilitada');
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
        Schema::dropIfExists('unidades');
    }
}
