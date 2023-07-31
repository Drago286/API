<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFallasTable extends Migration
{
    public function up()
    {
        Schema::create('Fallas', function (Blueprint $table) {
            $table->id();
            $table->string('Equipo')->nullable();
            $table->date('Fecha_Inicio')->nullable();
            $table->time('Hora_Inicio')->nullable();
            $table->date('Fecha_Final')->nullable();
            $table->time('Hora_Final')->nullable();
            $table->time('Duracion')->nullable();
            $table->string('Duracion_Excel')->nullable();
            $table->string('Codigo')->nullable();
            $table->string('Categoria')->nullable();
            $table->string('Descripcion')->nullable();
            $table->string('Comentario', 500)->nullable();
            $table->string('Caidas')->nullable();
            $table->string('Tipo_Mant')->nullable();
            $table->string('Sistema')->nullable();
            $table->string('Sub_Sistem')->nullable();
            $table->string('Componentes')->nullable();
            $table->string('Componente')->nullable();
            $table->string('Horas')->nullable();
            $table->string('Mes')->nullable();
            $table->string('Motor')->nullable();
            $table->string('Flota')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Fallas');
    }
}
