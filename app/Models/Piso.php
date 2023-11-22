<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piso extends Model
{
    use HasFactory;
    protected $table = 'piso';
    protected $fillable = [
        'numero',
        'direccion',
        'postal',
        'valor',
        'id_edificio',
        'id_cuenta',
        'estado'
    ];
    public function cuenta()
        {
            return $this->belongsTo(Cuenta::class, 'id_cuenta');
        }
}
