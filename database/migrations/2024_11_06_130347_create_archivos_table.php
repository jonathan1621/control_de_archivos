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
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();

            $table->integer('tipo_id');
            $table->string('descripcion'); // Puedes ajustar el tipo si la descripcion es corta o larga
            $table->string('archivo'); // Cambia 'file' a 'string' para almacenar el nombre o la descripcion del archivo
            $table->string('nombre_original')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivos');
    }
};
