<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;
class localController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locales = Local::get();
       return response()->json($locales);
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
       
        foreach($datos as $local){
            try{
                $datosLocal = [
                    'numero' => $local['numero'],
                    'dimensiones' => $local['dimensiones'],
                    'valor' => $local['valor'],
                    'id_piso' => $local['id_piso']
                ];  
                $media = Local::create($datosLocal);
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
        $local = Local::find($id);
        if (!$local) {
            return response()->json(['error' => 'Local no encontrado'], 404);
        }

        return response()->json($local);
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
     * * @param  \App\Models\Local $local
     */
    public function update(Request $request, Local $local)
    {
        $datos = $request->json()->all();
        try{ 
            $datosLocal = [
                'numero' => $datos['numero'],
                'dimensiones' => $datos['dimensiones'],
                'valor' => $datos['valor'],
                'id_piso' => $datos['id_piso']
            ];  
            $local->update($datosLocal);
            return response()->json(['message' => 'Registro Actualizado!'], 200);
        } catch(Exception $e){
            return response()->json(['error' => 'Error al actualizar el registro'], 501);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Local $local)
    {
        $local->delete();
        return response()->json(['message' => 'Registro Eliminado!'], 200);
    }
}
