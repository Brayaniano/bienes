<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Egreso;
use App\Models\Cuenta;
use App\Models\Edificio;
use App\Models\Piso;
use App\Models\Local;

class EgresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $egresos = Egreso::get();
        $egresos->load('edificio');
        $egresos->load('piso');
        $egresos->load('local');
        return view('egresos.index', 
                    compact('egresos'), 
                    [
                        'edit_succes' => false, 
                        'delete_succes' => false
                    ]
                );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cuentas = Cuenta::get();
        return view('egresos.create',compact('cuentas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validar = $this->getBienbyIdCuenta($request->id_cuenta);
        if (!$validar){
            $cuentas = Cuenta::get();
            return view('egresos.create', ['value' => false, 'error' => true , 'cuentas' =>  $cuentas]);
        }
        $fechaActual = new \DateTime();
        $fechaActual->format('Y-m-d H:i:s');
        $datosPiso = [
            'saldo' => $request->valor,
            'fecha_ingreso' => $fechaActual,
            'description' =>$request->description,
        ];
        $egreso = Egreso::create($datosPiso);
        $cuenta = Cuenta::find($request->id_cuenta);
        $egreso->cuenta()->associate($cuenta);
        if($validar['valor'] == 'edificios'){
            $egreso->edificio()->associate($validar['objeto'][0]);
        }
        if($validar['valor'] == 'pisos'){
            $egreso->piso()->associate($validar['objeto'][0]);
        }
        if($validar['valor'] == 'locales'){
            $egreso->local()->associate($validar['objeto'][0]);
        }
        $nuevoSaldo = $cuenta->saldo - $request->valor;
        $datosCuenta = [
            'saldo' => $nuevoSaldo
        ];  
            $cuenta->update($datosCuenta);
        $egreso->save();
        $egresos = Egreso::get();
        $egresos->load('edificio');
        $egresos->load('piso');
        $egresos->load('local');
        return redirect()->route('egresos.index', ['edit_succes' => true, 'delete_succes' => false, 'egresos' => $egresos]);

    }
}
