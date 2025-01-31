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
        Schema::create('inventorydata', function (Blueprint $table) {
            $table->id('idInventoryData');
            $table->integer('quantity');
            $table->float('price');
            $table->float('totalMovement');

            //Products
            $table->foreignId('idProduct')->references('idProduct')->on('products');

            //Tiempo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
