<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    protected $table = 'recibo'; // Especifica el nombre de la tabla si no sigue las convenciones de Laravel
    protected $fillable = [
        'id_cuenta',
        'id_edificio',
        'id_piso',
        'id_local',
        'id_inquilino',
        'fecha_emicion',
        'fecha_vencimiento',
        'agua',
        'luz',
        'renta',
        'ipc_anual',
        'posteria',
        'estado',
    ];

    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class, 'id_cuenta');
    }

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
    public function inquilino()
    {
        return $this->belongsTo(Local::class, 'id_inquilino');
    }
}
