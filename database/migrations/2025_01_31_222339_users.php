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
        Schema::create('users', function (Blueprint $table)
        {
            $table->id('idUser');
            $table->string('username', 100);
            $table->string('password', 255)->nullable();
            $table->string('email', 250)->unique();
            $table->string('pin', 255)->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('add_tema_to_users_table', 55)->nullable();
            // Timestamps para created_at y updated_at
            $table->timestamps();
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
