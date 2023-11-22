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
        Schema::create('egreso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cuenta')->nullable();
            $table->unsignedBigInteger('id_edificio')->nullable();
            $table->unsignedBigInteger('id_piso')->nullable();
            $table->unsignedBigInteger('id_local')->nullable();
            $table->decimal('saldo', 30, 2);
            $table->datetime('fecha_ingreso');
            $table->text('description');
            $table->timestamps();

            $table->foreign('id_cuenta')->references('id')->on('cuenta')->onDelete('cascade');
            $table->foreign('id_edificio')->references('id')->on('edificio')->onDelete('cascade');
            $table->foreign('id_local')->references('id')->on('local')->onDelete('cascade');
            $table->foreign('id_piso')->references('id')->on('piso')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egreso');
    }
};
