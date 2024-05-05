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
            $table->unsignedSmallInteger('año_desde')->after('año');
            $table->unsignedSmallInteger('año_hasta')->after('año_desde');
            $table->string('codigo_modelo')->after('modelo_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('details', function (Blueprint $table) {
            //
        });
    }
};
