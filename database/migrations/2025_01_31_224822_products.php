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


            //BaseProduc
            $table->foreignId('idBaseProduct')->references('idBaseProduct')->on('baseproducts');

            // Tiempo
            $table->timestamps();

            // Tiempo
            $table->softDeletes();
            $table->string('statusLogic',50); // Eliminado, No
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        // Eliminar la clave foránea antes de eliminar la tabla
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['idBaseProduct']);  // Eliminar la clave foránea
        });
        Schema::dropIfExists('products');
    }
};
