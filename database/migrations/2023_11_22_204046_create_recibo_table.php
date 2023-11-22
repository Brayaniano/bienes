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
        Schema::create('recibo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cuenta')->nullable();
            $table->unsignedBigInteger('id_edificio')->nullable();
            $table->unsignedBigInteger('id_piso')->nullable();
            $table->unsignedBigInteger('id_local')->nullable();
            $table->integer('id_inquilino')->nullable();
            $table->datetime('fecha_emicion');
            $table->datetime('fecha_vencimiento');
            $table->decimal('agua', 30, 2);
            $table->decimal('luz', 30, 2);
            $table->decimal('renta', 30, 2);
            $table->decimal('ipc_anual', 30, 2);
            $table->decimal('posteria', 30, 2);
            $table->integer('estado');
            $table->timestamps();

            $table->foreign('id_cuenta')->references('id')->on('cuenta')->onDelete('cascade');
            $table->foreign('id_edificio')->references('id')->on('edificio')->onDelete('cascade');
            $table->foreign('id_local')->references('id')->on('local')->onDelete('cascade');
            $table->foreign('id_piso')->references('id')->on('piso')->onDelete('cascade');
            $table->foreign('id_inquilino')->references('cedula')->on('inquilino')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recibo');
    }
};
