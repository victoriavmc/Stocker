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
        Schema::create('products', function (Blueprint $table) {
            $table->id('idProduct');
            $table->integer('code')->unique();
            $table->string('measure',100);
            $table->string('productType',100);
            $table->string('photo',255)->nullable();
            $table->string('statusLogic',50); // Eliminado, No

            //BaseProduc
            $table->foreignId('idBaseProduct')->references('idBaseProduct')->on('baseproducts');

            // Tiempo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
