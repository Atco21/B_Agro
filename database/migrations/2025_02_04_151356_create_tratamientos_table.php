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
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre', 100);
            $table->foreignId('quimico_id')->constrained('quimico')->onDelete('cascade');
            $table->string('descripcion', 100)->nullable();
            $table->string('dosis', 100)->nullable();
            $table->string('tempmax',100)->nullable();
            $table->string('tempmin',100)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tratamientos');
    }
};
