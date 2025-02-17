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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id('idAddres'); // Clave Primaria
            $table->string('street', 100);
            $table->integer('number');
            $table->string('neighborhood', 100)->nullable();
            $table->string('house', 100);
            $table->string('streetBlock', 100)->nullable();
            $table->string('sector', 100)->nullable();
            // Timestamps para created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
