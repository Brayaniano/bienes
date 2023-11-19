<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquilino;

class InquilinoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inquilinos = Inquilino::get();
        return view('inquilinos.index', 
        compact('inquilinos'), 
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
        return view('inquilinos.create');
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
       
        foreach($datos as $inquilino){
            try{
                $datosInquilino = [
                    'cedula' => $inquilino['cedula'],
                    'nombre' => $inquilino['nombre'],
                    'apellido' => $inquilino['apellido'],
                    'numero_cuenta' => $inquilino['numero_cuenta'],
                    'edad' => $inquilino['edad'],
                    'sexo' => $inquilino['sexo'],
                    'fecha_nacimiento' => $inquilino['fecha_nacimiento']
                ];  
                $media = Inquilino::create($datosInquilino);
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
        //
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
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
