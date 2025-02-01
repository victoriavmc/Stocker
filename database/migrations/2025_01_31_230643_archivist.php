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
        Schema::create('archivist', function (Blueprint $table) {
            $table->id('idArchivist');
            $table->date('date');
            $table->string('movementType', 60); //Entrada (COMPRA DONACION) - Salida (VENTA PERDIDA)
            $table->integer('invoiceNumber'); //numeroFactura

            // Tiempo
            $table->timestamps();

            // Timestamps para deleted_at
            $table->string('statusLogic',60); // No, Eliminado
            $table->softDeletes();

            // InventoryData
            $table->foreignId('idInventoryData')->references('idInventoryData')->on('inventorydata');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
                // Eliminar la clave foránea antes de eliminar la tabla
                Schema::table('archivist', function (Blueprint $table) {
                    $table->dropForeign(['idInventoryData']);  // Eliminar la clave foránea
                });
                Schema::dropIfExists('archivist');

    }
};
