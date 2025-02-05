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
            $table->integer('id_aplicador')->primary();
            $table->integer('id_explotacion')->nullable();
            $table->string('nombre')->nullable();
            $table->string('DNI')->nullable();
            $table->timestamps();
            $table->foreignId('id_explotacion')->constrained('explotaciones')->onDelete('cascade');

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
