<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquilino extends Model
{
    use HasFactory;
    protected $table = 'inquilino';
    protected $fillable = [
        'cedula',
        'nombre',
        'apellido',
        'numero_cuenta',
        'edad',
        'sexo',
        'fecha_nacimiento'
    ];
}
