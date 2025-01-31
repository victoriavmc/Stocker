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
        Schema::create('jobposition', function (Blueprint $table) {
            $table->id('idJobPosition');
            $table->date('startDate');
            $table->date('endDate')->nullable();
            $table->string('position', 100);
            $table->string('status',60); // Activo, Inactivo, Suspendido
            $table->string('statusLogic',60); // No, Eliminado
            $table->string('observation',100)->nullable();

            //Tiempo
            $table->timestamps();

            //Persons
            $table->foreignId('idPerson')->references('idPerson')->on('persons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
