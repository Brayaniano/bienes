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
        Schema::create('local', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('dimensiones');
            $table->decimal('valor', 10, 2);
            $table->integer('id_piso')->nullable();
            $table->integer('estado');
            $table->unsignedBigInteger('id_cuenta');
            $table->timestamps();

            $table->foreign('id_cuenta')->references('id')->on('cuenta')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('local');
    }
};