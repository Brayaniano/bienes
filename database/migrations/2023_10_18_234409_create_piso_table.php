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
        Schema::create('piso', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('direccion');
            $table->integer('postal');
            $table->decimal('valor', 10, 2);
            $table->integer('id_edificio')->nullable();
            $table->unsignedBigInteger('id_cuenta');
            $table->integer('estado');
            $table->timestamps();

            $table->foreign('id_cuenta')->references('id')->on('cuenta')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piso');
    }
};
