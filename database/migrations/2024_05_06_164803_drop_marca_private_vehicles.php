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
            

            // Añadir columna para almacenar el ID de la versión de motorización
            $table->unsignedBigInteger('version_id');

          
            $table->foreign('version_id')->references('id')->on('motorizaciones')->onDelete('cascade');

           
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
