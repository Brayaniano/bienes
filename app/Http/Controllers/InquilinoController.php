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
            $inquilinos = Inquilino::get();
            $validar = $this->validarCedule($request->cedula);
            if (!$validar){
                return view('inquilinos.create', ['value' => false, 'error' => true],compact('inquilinos'));
            }
       
            try{
                $datosInquilino = [
                    'cedula' => $request->cedula,
                    'apellido' => $request->apellido,
                    'nombre' =>$request->nombre,
                    'numero_cuenta' => $request->numero_cuenta,
                    'edad' => $request->edad,
                    'sexo' => $request->sexo,
                    'fecha_nacimiento' => $request->fecha_nacimiento
                ];  
                $media = Inquilino::create($datosInquilino);
                $inquilinos = Inquilino::get();
        return view('inquilinos.index', 
        compact('inquilinos'), 
        [
            'edit_succes' => true, 
            'delete_succes' => false
        ]);
            } catch(Exception $e){
                return response()->json(['error' => 'Error al crear el registro'], 501);
            }

        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $inquilino = Inquilino::where('cedula', $id)->first();
        return view('inquilinos.show', compact('inquilino'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $inquilino = Inquilino::where('cedula', $id)->first();
        return view('inquilinos.edit', compact('inquilino'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inquilino = Inquilino::where('cedula', $id)->first();
        try{
            $datosInquilino = [
                'apellido' => $request->apellido,
                'nombre' =>$request->nombre,
                'numero_cuenta' => $request->numero_cuenta,
                'edad' => $request->edad,
                'sexo' => $request->sexo,
                'fecha_nacimiento' => $request->fecha_nacimiento
            ];  
            $inquilino->update($datosInquilino);
            $inquilinos = Inquilino::get();
            return redirect()->route('inquilinos.index', ['edit_succes' => true, 'delete_succes' => false, 'inquilinos' => $inquilinos]);
        } catch(Exception $e){
            return response()->json(['error' => 'Error al crear el registro'], 501);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inquilino = Inquilino::where('cedula', $id)->first();
        $inquilino->delete();
        $inquilinos = Inquilino::get();
        return redirect()->route('inquilinos.index', ['edit_succes' => false, 'delete_succes' => true, 'inquilinos' => $inquilinos]);
    }

    public function validarCedule($cedula){
        $inquilino = Inquilino::where('cedula', $cedula)->first();
        if(!$inquilino){
            return true;
        }else{
            return false;
        }
    }
}
