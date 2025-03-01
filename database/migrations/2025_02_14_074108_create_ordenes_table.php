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
            $table->enum ('estado',['pendiente','pasado','encurso','terminada']);
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('horaOrden')->nullable();
            $table->string('tarea', 255);
            $table->foreignId('jefecampo_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('aplicador_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('parcela_id')->constrained('parcelas')->onDelete('cascade');
            $table->foreignId('id_tratamiento')->nullable()->constrained('tratamientos')->onDelete('cascade');
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
