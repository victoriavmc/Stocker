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
        Schema::create('persons', function (Blueprint $table) {
            $table->id('idPerson');

            // Claves foráneas

            //User
            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')->references('idUser')->on('users');

            //PersonalData
            $table->unsignedBigInteger('idPersonalData');
            $table->foreign('idPersonalData')->references('idPersonalData')->on('personaldata');

            //Address
            $table->unsignedBigInteger('idAddres');
            $table->foreign('idAddres')->references('idAddres')->on('addresses');


            // Timestamps para created_at y updated_at
            $table->timestamps();

            // Timestamps para deleted_at
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->dropForeign(['idUser']);
            $table->dropForeign(['idPersonalData']);
            $table->dropForeign(['idAddres']);
        });

        Schema::dropIfExists('persons');
    }

};
