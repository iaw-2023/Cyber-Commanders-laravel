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
        Schema::create('salas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('capacidad');
            $table->string('tipo');
            $table->string('nombre');
            $table->unsignedBigInteger('funcion_id'); 
            $table->foreign('funcion_id')->references('id')->on('funciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salas');
    }
};
