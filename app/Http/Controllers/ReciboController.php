<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recibo;
use App\Models\Cuenta;
use App\Models\Piso;
use App\Models\Local;
use App\Models\Edificio;

class ReciboController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recibos = Recibo::get();
        return view('recibos.index', 
        compact('recibos'), 
        [
            'edit_succes' => false, 
            'delete_succes' => false
        ]
    );
    }

    public function storeEdificio(Request $request)
    {
        $edificio = Edificio::find($request->id);
        $edificio->cuenta;
        $cuenta = Cuenta::find($edificio->cuenta);
        $fechaHoraActual = new \DateTime();
        // Obtener el primer día del mes
        $primerDiaMes = new \DateTime($fechaHoraActual->format('Y-m-01 00:00:00'));
        // Obtener el último día del mes
        $ultimoDiaMes = new \DateTime($fechaHoraActual->format('Y-m-t 23:59:59'));
        $datosRecibo = [
            'fecha_emicion' => $primerDiaMes,
            'fecha_vencimiento' => $ultimoDiaMes,
            'agua' =>$request->agua,
            'luz' => $request->luz,
            'renta' => $request->renta,
            'ipc_anual' => $request->ipc_anual,
            'posteria' => $request->porteria,
            'estado' => 10
        ];  
        
        $recibo = Recibo::create($datosRecibo);
        $recibo->cuenta()->associate($cuenta[0]); 
        $recibo->edificio()->associate($edificio); 
        $recibo->save();
        $nuevoSaldo = $request->agua + $request->luz + $request->renta + $request->ipc_anual + $request->porteria + $cuenta[0]->saldo;
        $datosCuenta = [
            'saldo' => $nuevoSaldo
        ];  
            $cuenta[0]->update($datosCuenta);
        $recibos = Recibo::get();
        return view('recibos.index', 
        compact('recibos'), 
        [
            'edit_succes' => false, 
            'delete_succes' => false
        ]
    );
    }

    public function storeLocal(Request $request)
    {
        $edificio = Local::find($request->id);
        $edificio->cuenta;
        $cuenta = Cuenta::find($edificio->cuenta);
        $fechaHoraActual = new \DateTime();
        // Obtener el primer día del mes
        $primerDiaMes = new \DateTime($fechaHoraActual->format('Y-m-01 00:00:00'));
        // Obtener el último día del mes
        $ultimoDiaMes = new \DateTime($fechaHoraActual->format('Y-m-t 23:59:59'));
        $datosRecibo = [
            'fecha_emicion' => $primerDiaMes,
            'fecha_vencimiento' => $ultimoDiaMes,
            'agua' =>$request->agua,
            'luz' => $request->luz,
            'renta' => $request->renta,
            'ipc_anual' => $request->ipc_anual,
            'posteria' => $request->porteria,
            'estado' => 10
        ];  
        
        $recibo = Recibo::create($datosRecibo);
        $recibo->cuenta()->associate($cuenta[0]); 
        $recibo->edificio()->associate($edificio); 
        $recibo->save();
        $nuevoSaldo = $request->agua + $request->luz + $request->renta + $request->ipc_anual + $request->porteria + $cuenta[0]->saldo;
        $datosCuenta = [
            'saldo' => $nuevoSaldo
        ];  
            $cuenta[0]->update($datosCuenta);
        $recibos = Recibo::get();
        return view('recibos.index', 
        compact('recibos'), 
        [
            'edit_succes' => false, 
            'delete_succes' => false
        ]
    );
    }

    public function storePiso(Request $request)
    {
        $edificio = Piso::find($request->id);
        $edificio->cuenta;
        $cuenta = Cuenta::find($edificio->cuenta);
        $fechaHoraActual = new \DateTime();
        // Obtener el primer día del mes
        $primerDiaMes = new \DateTime($fechaHoraActual->format('Y-m-01 00:00:00'));
        // Obtener el último día del mes
        $ultimoDiaMes = new \DateTime($fechaHoraActual->format('Y-m-t 23:59:59'));
        $datosRecibo = [
            'fecha_emicion' => $primerDiaMes,
            'fecha_vencimiento' => $ultimoDiaMes,
            'agua' =>$request->agua,
            'luz' => $request->luz,
            'renta' => $request->renta,
            'ipc_anual' => $request->ipc_anual,
            'posteria' => $request->porteria,
            'estado' => 10
        ];  
        
        $recibo = Recibo::create($datosRecibo);
        $recibo->cuenta()->associate($cuenta[0]); 
        $recibo->piso()->associate($edificio); 
        $recibo->save();
        $nuevoSaldo = $request->agua + $request->luz + $request->renta + $request->ipc_anual + $request->porteria + $cuenta[0]->saldo;
        $datosCuenta = [
            'saldo' => $nuevoSaldo
        ];  
            $cuenta[0]->update($datosCuenta);
        $recibos = Recibo::get();
        return view('recibos.index', 
        compact('recibos'), 
        [
            'edit_succes' => false, 
            'delete_succes' => false
        ]
    );
    }
}
