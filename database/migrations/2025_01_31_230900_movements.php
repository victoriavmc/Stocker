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
        Schema::create('movements', function (Blueprint $table) {
            $table->id('idMovement');
            $table->string('statusLogic', 50);

            //Archivist
            $table->foreignId('idArchivist')->references('idArchivist')->on('archivist');

            //Tiempo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
