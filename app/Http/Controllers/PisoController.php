<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Piso;

class PisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pisos = Piso::get();
       return response()->json($pisos); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->json()->all();
        $size = sizeof($datos);
        if($size == 0){
            return response()->json(['Error' => 'Ingrese por lo menos un registro'], 500);
        }
       
        foreach($datos as $piso){
            try{
                $datosPiso = [
                    'numero' => $piso['numero'],
                    'direccion' => $piso['direccion'],
                    'postal' => $piso['postal'],
                    'valor' => $piso['valor']
                ];  
                $media = Piso::create($datosPiso);
            } catch(Exception $e){
                return response()->json(['error' => 'Error al crear el registro'], 501);
            }

        }
        
        return response()->json(['message' => 'Registro ingresado!'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $piso = Piso::find($id);
        if (!$piso) {
            return response()->json(['error' => 'Piso no encontrado'], 404);
        }

        return response()->json($piso);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Models\Piso $piso
     */
    public function update(Request $request, Piso $piso)
    {
        $datos = $request->json()->all();
        try{ 
            $datosPiso = [
                'numero' => $datos['numero'],
                'direccion' => $datos['direccion'],
                'postal' => $datos['postal'],
                'valor' => $datos['valor']
            ];  
            $piso->update($datosPiso);
            return response()->json(['message' => 'Registro Actualizado!'], 200);
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
    public function destroy(Piso $piso)
    {
        $piso->delete();
        return response()->json(['message' => 'Registro Eliminado!'], 200);
    }
}
