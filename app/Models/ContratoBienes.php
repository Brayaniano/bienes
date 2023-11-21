<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoBienes extends Model
{
    use HasFactory;
    protected $table = 'contrato_bienes';
    protected $fillable = [
            'id_contrato',
            'id_edificio',
            'id_piso',
            'id_local'
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
}
