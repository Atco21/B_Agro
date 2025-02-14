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
            $table->foreignId('id_jefecampo')->constrained('trabajadores')->onDelete('cascade');
            $table->foreignId('aplicador_id')->constrained('trabajadores')->onDelete('cascade');
            $table->foreignId('parcela_id')->constrained('parcelas')->onDelete('cascade');
            $table->foreignId('id_tratamiento')->constrained('tratamientos')->onDelete('cascade');
            $table->foreignId('id_maquina')->nullable()->constrained('maquina')->nullable();
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
