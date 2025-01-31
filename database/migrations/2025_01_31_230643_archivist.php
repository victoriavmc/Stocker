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
            $table->id('IdArchivist');
            $table->date('date');
            $table->string('movementType');
            $table->integer('invoiceNumber');
            $table->foreignId('IdInventoryData')->references('IdInventoryData')->on('inventorydata');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
