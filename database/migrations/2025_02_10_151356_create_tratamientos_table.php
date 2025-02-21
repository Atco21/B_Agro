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
            $table->id(); //porque he camiado el nombre tenia que poner esto
            $table->timestamps();
            //producto quimico seria id_quimico y hara una clave ajena a la tabla de quimicos
            $table->string('producto_quimico', 100);
            $table->string('dosis', 100);
            $table->string('nombre_tratamiento', 100);
            $table->double('tempmax',100);
            $table->double('tempmin',100);
            $table->foreignId('id_jefedecampo')->constrained('users');


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
