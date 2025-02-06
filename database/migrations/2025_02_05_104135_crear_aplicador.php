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
        Schema::create('aplicador', function (Blueprint $table) {
            $table->increments('id'); // Auto-incremental primary key
            $table->string('nombre')->nullable();
            $table->string('DNI')->nullable();
            $table->timestamps();

            // Definir clave foránea correctamente (sin repetirla)
            $table->foreignId('id_explotacion')->nullable()->constrained('explotaciones')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplicador');
    }
};
