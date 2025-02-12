<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. ghvbybyb
     */
    public function up(): void
    {
        Schema::create('rendimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parcela_id')->constrained('parcelas')->onDelete('cascade');
            $table->double('c_sembrada');
            $table->double('c_recolectada');
            $table->double('c_esperada');
            $table->double('semillaCostes');
            $table->double('fertilizantesCostes');
            $table->double('otrosCostes');
            $table->double('precio_tonelada');
            $table->double('total_vendido');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendimiento');
    }
};
