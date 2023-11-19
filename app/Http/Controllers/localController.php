<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;
use App\Models\Piso;

class localController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locales = Local::get();
        return view('locales.index', 
        compact('locales'), 
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
        $pisos = Piso::where('estado', 1)->get();
        return view('locales.create', compact('pisos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $datosLocal = [
                'numero' => $request->numero,
                'dimensiones' => $request->dimensiones,
                'valor' => $request->valor,
                'id_piso' => $request->id_piso,
                'estado' => $request->estado
            ];  
            $media = Local::create($datosLocal);
        } catch(Exception $e){
            return response()->json(['error' => 'Error al crear el registro'], 501);
        }
        $pisos = Piso::where('estado', 1)->get();
        return view('locales.create', ['value' => true],compact('pisos'));
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

        return view('locales.show', compact('local'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pisos = Piso::where('estado', 1)->get();
        $local = Local::find($id);
        return view('locales.edit', compact('pisos','local'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $local = Local::find($id);
        try{
            $datosLocal = [
                'numero' => $request->numero,
                'dimensiones' => $request->dimensiones,
                'valor' => $request->valor,
                'id_piso' => $request->id_piso,
                'estado' => $request->estado
            ];  
            $local->update($datosLocal);
            $locales = Local::get();
            return redirect()->route('locales.index', ['edit_succes' => true, 'delete_succes' => false, 'locales' => $locales]);
        } catch(Exception $e){
            "";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $local = Local::find($id);
        $local->delete();
        $locales = Local::get();
        return redirect()->route('locales.index',
        [
            'edit_succes' => false, 
            'delete_succes' => true,
            'locales' => $locales
        ]
    );
    }
}