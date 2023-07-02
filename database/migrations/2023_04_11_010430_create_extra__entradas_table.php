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
        Schema::create('extras_entradas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('cantidad');
            $table->unsignedBigInteger('extras_id'); 
            $table->foreign('extras_id')->references('id')->on('extras');
            $table->unsignedBigInteger('entradas_id'); 
            $table->foreign('entradas_id')->references('id')->on('entradas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extras_entradas');
    }
};
