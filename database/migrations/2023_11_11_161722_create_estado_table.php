<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estado', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->timestamps();
        });

        $estados = [
            ['status' => 'Disponible'],
            ['status' => 'Alquilado'],
            ['status' => 'En Proceso de Alquiler'],
            ['status' => 'No Disponible'],
            ['status' => 'Vigente'],
            ['status' => 'Expirado'],
            ['status' => 'Proximo a entrar en vigencia'],
        ];
        foreach ($estados as $estado) {
            DB::table('estado')->insert($estado);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado');
    }
};
