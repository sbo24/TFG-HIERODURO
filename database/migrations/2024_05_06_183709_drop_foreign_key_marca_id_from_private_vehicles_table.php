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
            $table->dropForeign('private_vehicles_modelo_id_foreign');
            $table->dropForeign('private_vehicles_version_id_foreign');
            $table->dropForeign('private_vehicles_codigo_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('private_vehicles', function (Blueprint $table) {
            //
        });
    }
};
