<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->mediumText('descripcion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->string('tipo');
            $table->string('estado');
            $table->string('provincia');
            $table->string('poblacion');
            $table->string('direccion');
            $table->string('hora_inicio');
            $table->string('hora_fin')->nullable();
            $table->integer('id_creator');
            $table->string('mensaje_cierre');
            $table->integer('max_participantes');
            $table->integer('num_participantes');
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
        Schema::dropIfExists('activities');
    }
}
