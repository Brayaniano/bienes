<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;
    protected $table = 'contrato';
    protected $fillable = [
            'id_inquilino',
            'valor_total_mensual',
            'fecha_inicio',
            'fecha_fin',
            'estado',
    ];
}
