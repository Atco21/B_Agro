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
        Schema::create('maquina', function (Blueprint $table) {
            $table->id();

            $table->foreignId('explotacion_id')->constrained('explotaciones');

            $table->string('nombre');
            $table->string('matricula');
            $table->double('capacidad')->nullable();
            $table->integer('estado')->nullable();
            $table->string('imagen', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maquina');
    }
};
