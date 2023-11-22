<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;
    protected $table = 'ingreso';
    protected $fillable = [
        'id',
        'id_cuenta',
        'id_edificio',
        'id_piso',
        'id_local',
        'saldo',
        'fecha_ingreso',
        'descripcion',
    ];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'id_edificio');
    }

    public function piso()
    {
        return $this->belongsTo(Piso::class, 'id_piso');
    }

    public function local()
    {
        return $this->belongsTo(Local::class, 'id_local');
    }
    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class, 'id_cuenta');
    }
}
