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
        Schema::create('personaldata',
         function (Blueprint $table) {
            $table->id('idPersonalData'); // Clave Primaria

            $table->string('firstName', 100);

            $table->string('lastName', 100);

            $table->string('cuit', 50)->unique();

            $table->date('birthdate');

            $table->string('gender', 50);

            $table->string('nationality', 100);

            // Timestamps para created_at y updated_at
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personaldata');
    }
};
