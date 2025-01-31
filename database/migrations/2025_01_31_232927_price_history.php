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
            $table->id('IdPriceHistory');
            $table->float('unitPrice');
            $table->date('startSeason');
            $table->date('endSeason');
            $table->foreignId('IdProduct')->references('IdProduct')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
