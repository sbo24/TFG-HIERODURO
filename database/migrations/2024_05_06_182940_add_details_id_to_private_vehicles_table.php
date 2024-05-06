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
            $table->unsignedBigInteger('details_id')->nullable();
            $table->foreign('details_id')->references('id')->on('details')->onDelete('cascade');
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
