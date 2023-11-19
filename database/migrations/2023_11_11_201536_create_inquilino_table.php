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
        Schema::create('inquilino', function (Blueprint $table) {
            $table->integer('cedula')->primary();
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('numero_cuenta');
            $table->integer('edad');
            $table->string('sexo');
            $table->date('fecha_nacimiento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquilino');
    }
};
