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
        Schema::table('details', function (Blueprint $table) {


            // Añadir columna para almacenar el ID del código del modelo
            $table->unsignedBigInteger('codigo_id');

            // Definir restricción de clave externa
            $table->foreign('codigo_id')->references('id')->on('codigo_modelo')->onDelete('cascade');
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
