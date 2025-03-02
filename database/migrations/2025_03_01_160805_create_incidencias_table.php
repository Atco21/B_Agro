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
        Schema::create('incidencia', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha');
            $table->string('descripcion');
            $table->string('solucion')->nullable();
            $table->enum('estado',['pendiente','resuelta']);
            $table->enum ('tipo',['personal','stock','maquina']);
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('orden_id')->nullable()->constrained('ordenes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencia');
    }
};
