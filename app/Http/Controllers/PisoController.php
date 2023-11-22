<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Piso;
use App\Models\Local;
use App\Models\Edificio;
use App\Models\Cuenta;

class PisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pisos = Piso::get();
        return view('pisos.index', 
                    compact('pisos'), 
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
        $edificios = Edificio::where('estado', 1)->get();
        return view('pisos.create', compact('edificios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validar = $this->validateCuenta($request->id_cuenta);
        if (!$validar){
            $edificios = Edificio::where('estado', 1)->get();
            return view('pisos.create', ['value' => false, 'error' => true , 'edificios' =>  $edificios]);
        }
        $cuenta = $this->createCuenta($request->id_cuenta);
       try{
                $datosPiso = [
                    'numero' => $request->numero,
                    'direccion' => $request->direccion,
                    'postal' =>$request->postal,
                    'valor' => $request->valor,
                    'id_edificio' => $request->id_edificio,
                    'id_cuenta' => $request->id_cuenta,
                    'estado' => $request->estado
                ];  
                $piso = Piso::create($datosPiso);
                $piso->cuenta()->associate($cuenta); 
                $piso->save();
            } catch(Exception $e){
                return response()->json(['error' => 'Error al crear el registro'], 501);
            }

            $edificios = Edificio::where('estado', 1)->get();
            return view('pisos.create', ['value' => true],compact('edificios'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $piso = Piso::find($id);
        $locales = Local::where('id_piso', $id)->get();
        if (!$piso) {
            return "";
        }
        $piso->load('cuenta');
        return view('pisos.show', compact('piso', 'locales'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edificios = Edificio::where('estado', 1)->get();
        $piso = Piso::find($id);
        return view('pisos.edit', compact('edificios','piso'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Models\Piso $piso
     */
    public function update(Request $request, $id)
    {
        $piso = Piso::find($id);
        try{ 
            $datosPiso = [
                'numero' => $request->numero,
                'direccion' => $request->direccion,
                'postal' =>$request->postal,
                'valor' => $request->valor,
                'id_edificio' => $request->id_edificio,
                'estado' => $request->estado
            ];  
            $piso->update($datosPiso);
            $pisos = Piso::get();
            return redirect()->route('pisos.index', ['edit_succes' => true, 'delete_succes' => false, 'pisos' => $pisos]);
        } catch(Exception $e){
            return response()->json(['error' => 'Error al actualizar el registro'], 501);
        }
    }

/**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Piso  $piso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $piso = Piso::find($id);
        $piso->delete();
        $pisos = Piso::get();
        return redirect()->route('pisos.index', ['edit_succes' => false, 'delete_succes' => true, 'pisos' => $pisos]);
    }

    public function validateCuenta($id){
        $cuenta = Cuenta::where('id', $id)->first();
        if(!$cuenta){
            return true;
        }else{
            return false;
        }
    }

    public function createCuenta($id){
        try{
            $datosCuenta = [
                'id' => $id,
                'saldo' => 0
            ];  
            $media = Cuenta::create($datosCuenta);
            $cuenta = Cuenta::where('id', $id)->first();
            return $cuenta;
        } catch(Exception $e){
            return false;
        }
    }
 
}
