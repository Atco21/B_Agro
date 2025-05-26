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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->date('fecha')->default(now());
            $table->enum('tipo_pago', ['efectivo', 'tarjeta', 'transferencia', 'cheque'])->default('efectivo');
            $table->enum('estado', ['pendiente', 'pagada', 'vencida'])->default('pendiente');
            $table->decimal('neto', 12, 2);
            $table->decimal('impuestos', 12, 2);
            $table->decimal('total', 14, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
