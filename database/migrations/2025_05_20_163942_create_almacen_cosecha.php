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

            $table->foreignId('almacen_id')->constrained('almacen')->onDelete('cascade');
            $table->foreignId('cultivo_id')->constrained('cultivos')->onDelete('cascade');

            $table->integer('stock')->default(0);

            $table->unique(['almacen_id', 'cultivo_id']);
            $table->enum('unidad',['u', 'g', 'kg','T']);
            $table->decimal('precioPorUnidad', 10, 2)->nullable();

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
