<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('private_vehicles', function (Blueprint $table) {
            // Añadir columna para almacenar el ID de la marca
            $table->unsignedBigInteger('marca_id');

            // Añadir columna para almacenar el ID del modelo
            $table->unsignedBigInteger('modelo_id');

            // Definir restricciones de clave externa
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
            $table->foreign('modelo_id')->references('id')->on('modelos')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
