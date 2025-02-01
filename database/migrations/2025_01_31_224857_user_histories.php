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
        //
        Schema::create('userhistories', function (Blueprint $table) {
            $table->id('idUserHistory'); // Clave Primaria
            $table->string('statusLogic', 100); //Activo Inactivo Suspendido

            // Timestamps para created_at y updated_at
            $table->timestamps();

            // Persons
            $table->unsignedBigInteger('idPerson');
            $table->foreign('idPerson')->references('idPerson')->on('persons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar la clave foránea antes de eliminar la tabla
        Schema::table('userhistories', function (Blueprint $table) {
            $table->dropForeign(['idPerson']);  // Eliminar la clave foránea
        });
        Schema::dropIfExists('userhistories');
    }
};
