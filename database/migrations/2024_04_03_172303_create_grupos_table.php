<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');

            $table->unsignedBigInteger('idDocente')->nullable();
            $table->foreign('idDocente')
                  ->references('id')->on('docentes')
                  ->onDelete('set null');

            $table->unsignedBigInteger('idMateria')->nullable();
            $table->foreign('idMateria')
                  ->references('id')->on('materia')
                  ->onDelete('set null');

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
        Schema::dropIfExists('grupos');
    }

}
