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
        Schema::create('pricehistory', function (Blueprint $table) {
            $table->id('idPriceHistory');
            $table->float('unitPrice');
            $table->date('startSeason');
            $table->date('endSeason')->nullable();

            //Products
            $table->foreignId('idProduct')->references('idProduct')->on('products');

            //Tiempo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        // Eliminar la clave foránea antes de eliminar la tabla
        Schema::table('pricehistory', function (Blueprint $table) {
            $table->dropForeign(['idProduct']);  // Eliminar la clave foránea
        });
        Schema::dropIfExists('pricehistory');
    }
};
