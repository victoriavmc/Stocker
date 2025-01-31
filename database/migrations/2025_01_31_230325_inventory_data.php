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
            $table->id('IdInventoryData');
            $table->integer('quantity');
            $table->float('price');
            $table->float('totalMovement');
            $table->foreignId('IdProduct')->references('IdProduct')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
