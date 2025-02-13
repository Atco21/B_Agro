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
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->id();

            //datos personales
            $table->string('nombre_completo', 255);
            $table->string('id_jefeCampo', 9)->unique();
            $table->string('telefono', 9);
            $table->string('email', 255)->unique();
            $table->date('fecha_nacimiento');

            //datos de usuario
            $table->string('usuario', 255);
            $table->string('password', 255);
            $table->integer('rol');
            $table->string('imagen', 255)->nullable();


            //tipo de empleado
            $table->foreignId('explotacion_id')->constrained('explotaciones');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajadores');
    }
};
