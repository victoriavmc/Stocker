<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Pest\Laravel\delete;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id('idReport');
            $table->string('observation',200);

            //Tiempo creado/modificado
            $table->timestamps();

            // Timestamps para deleted_at
            $table->string('statusLogic',60); // No, Eliminado
            $table->softDeletes();

            //Archivist
            $table->foreignId('idArchivist')->references('idArchivist')->on('archivist');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        // Eliminar la clave foránea antes de eliminar la tabla
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['idArchivist']);  // Eliminar la clave foránea
        });
        Schema::dropIfExists('reports');

}
};
