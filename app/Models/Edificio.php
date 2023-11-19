<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    use HasFactory;
    protected $table = 'edificio';
    protected $fillable = [
        'nombre',
        'direccion',
        'postal',
        'valor',
        'estado'
    ];
}