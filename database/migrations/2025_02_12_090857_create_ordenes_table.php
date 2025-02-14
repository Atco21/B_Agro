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
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->string('estado', 50);
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->string('tarea', 255);
            $table->foreignId('id_jefecampo')->constrained('trabajadores');
            $table->foreignId('aplicador_id')->constrained('trabajadores');
            $table->foreignId('parcela_id')->constrained('parcelas');
            $table->foreignId('id_tratamiento')->nullable()->constrained('tratamientos');
            $table->foreignId('id_maquina')->nullable()->constrained('maquina');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};