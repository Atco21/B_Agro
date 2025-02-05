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
        Schema::create('almacen_quimico', function (Blueprint $table) {
            $table->integer('id_almacen')->unsigned();
            $table->integer('id_quimico')->unsigned();

            $table->timestamps();

             //relaciones
             $table->foreign('id_almacen')->references('id')->on('almacenes')->onDelete('cascade')->onUpdate('cascade');
             $table->foreign('id_quimico')->references('id')->on('quimicos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('almacen_quimico');
    }
};
