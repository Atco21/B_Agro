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
            $table->enum('estado', ['en_curso','pendiente','pausada']); // Si los valores son fijos
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('id_administrador');
            $table->foreignId('id_jefecampo')->constrained('trabajadores');//la tabla trabajadores es la tabla jefe de campo en el miro
            $table->foreignId("aplicador_id")->constrained('trabajadores');
            $table->foreignId("parcela_id")->constrained('parcelas');
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
