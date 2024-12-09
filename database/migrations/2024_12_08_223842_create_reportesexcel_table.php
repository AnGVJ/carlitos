<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reportesexcel', function (Blueprint $table) {
            $table->id();  // Columna 'id' autoincrementable
            $table->string('nombre');  // Columna para el nombre del reporte
            $table->date('fechadecreacion');  // Columna para la fecha de creación del reporte
            $table->string('numeroexcel');  // Columna para el número del reporte de Excel
            $table->timestamps();  // Crea las columnas 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportesexcel');
    }
};
