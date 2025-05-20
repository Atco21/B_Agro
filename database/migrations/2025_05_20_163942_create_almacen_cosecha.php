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
        Schema::create('almacen_cosecha', function (Blueprint $table) {
            $table->id();

            $table->foreignId('almacen_id')->constrained()->onDelete('cascade');
            $table->foreignId('cosecha_id')->constrained()->onDelete('cascade');

            $table->unique(['almacen_id', 'cosecha_id']);
            $table->enum('unidad_medida',['u', 'g', 'kg','T']);
            $table->decimal('precioPorMedida', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('almacen_cosecha');
    }
};
