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
        Schema::create('audits', function (Blueprint $table)
        {
            $table->id('idAudit');
            $table->string('tableName', 100);
            $table->integer('recordId');
            $table->string('action');
            $table->string('oldValue', 255)->nullable();
            $table->string('newValue', 255);
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
        Schema::table('audits', function (Blueprint $table) {
            $table->dropForeign(['idPerson']);  // Eliminar la clave foránea
        });
        Schema::dropIfExists('audits');
    }
};
