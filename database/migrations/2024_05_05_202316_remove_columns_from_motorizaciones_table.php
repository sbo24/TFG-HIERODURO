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
        Schema::table('motorizaciones', function (Blueprint $table) {
            // Elimina las columnas específicas
            $table->dropColumn('año');
            $table->dropColumn('tipo_combustible');
            $table->dropColumn('tipo_cambio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('motorizaciones', function (Blueprint $table) {
            //
        });
    }
};
