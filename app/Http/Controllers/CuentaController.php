<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuenta;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cuentas = Cuenta::get();
        return view('cuentas.index', 
        compact('cuentas'), 
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
        return view('cuentas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validar = $this->validateCuenta($request->id);
        if (!$validar){
            return view('cuentas.create', ['value' => false, 'error' => true]);
        }
        try{
            $datosCuenta = [
                'id' => $request->id,
                'saldo' => $request->saldo
            ];  
            $media = Cuenta::create($datosCuenta);
            $cuentas = Cuenta::get();
            return view('cuentas.index', 
            compact('cuentas'), 
            [
                'edit_succes' => true, 
                'delete_succes' => false
            ]);
        } catch(Exception $e){
            return response()->json(['error' => 'Error al crear el registro'], 501);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cuenta = Cuenta::where('id', $id)->first();
        return view('cuentas.edit', compact('cuenta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cuenta = Cuenta::where('id', $id)->first();
        try{
        $datosCuenta = [
            'saldo' => $request->saldo
        ];  
            $cuenta->update($datosCuenta);
            $cuentas = Cuenta::get();
            return redirect()->route('cuentas.index', ['edit_succes' => true, 'delete_succes' => false, 'cuentas' => $cuentas]);
        } catch(Exception $e){
            return response()->json(['error' => 'Error al crear el registro'], 501);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cuenta = Cuenta::where('id', $id)->first();
        $cuenta->delete();
        $cuentas = Cuenta::get();
        return redirect()->route('cuentas.index', ['edit_succes' => false, 'delete_succes' => true, 'cuentas' => $cuentas]);
    }

    public function validateCuenta($id){
        $cuenta = Cuenta::where('id', $id)->first();
        if(!$cuenta){
            return true;
        }else{
            return false;
        }
    }
}
