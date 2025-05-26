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
            $table->id();
            $table->foreignId('almacen_id')->constrained('almacen')->onDelete('cascade');
            $table->foreignId('quimico_id')->constrained('quimico')->onDelete('cascade');
            $table->enum('unidad',['u', 'g', 'ml', 'L']);
            $table->integer('stock_minimo')->default(0);
            $table->integer('stock_maximo')->default(0);
            $table->integer('stock')->default(0);
            $table->timestamps();
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
