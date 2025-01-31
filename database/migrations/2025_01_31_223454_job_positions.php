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
        Schema::create('jobposition', function (Blueprint $table) {
            $table->id('IdJobPosition');
            $table->date('startDate');
            $table->date('endDate');
            $table->string('position');
            $table->string('status');
            $table->string('statusLogic');
            $table->string('observation');
            $table->foreignId('IdPerson')->references('IdPerson')->on('persons');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
