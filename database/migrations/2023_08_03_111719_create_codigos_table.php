<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('codigos', function (Blueprint $table) {

            $table->id();
            $table->string('Codigo')->nullable();
            $table->string('Descripcion_del_Evento', 2000)->nullable();
            $table->string('Limitaciones_del_evento', 2000)->nullable();
            $table->string('Deteccion_de_la_informacion', 2000)->nullable();
            $table->string('Guia_para_la_Deteccion_de_Fallas', 2000)->nullable();
            $table->string('Equipo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codigos');
    }
};
