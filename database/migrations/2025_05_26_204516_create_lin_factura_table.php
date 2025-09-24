<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('factura_lineas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('factura_id')->constrained('facturas')->onDelete('cascade');
            $table->unsignedInteger('numero_linea');
            $table->foreignId('cultivo_id')->constrained('cultivos');
            $table->foreignId('explotacion_id')->constrained('explotaciones');
            $table->decimal('precio_unitario', 12, 2);
            $table->decimal('cantidad', 12, 2);
            $table->decimal('subtotal', 14, 2);
            $table->timestamps();

            $table->unique(['factura_id', 'numero_linea']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factura_lineas');
    }
};
