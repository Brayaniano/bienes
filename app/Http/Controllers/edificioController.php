<?php

namespace App\Http\Controllers;


use App\Models\Edificio;
use App\Models\Piso;
use App\Models\Local;
use Illuminate\Http\Request;

class edificioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $edificios = Edificio::get();
        return view('edificios.index', 
                    compact('edificios'), 
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
        return view('edificios.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $datosEdificio = [
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'postal' =>$request->postal,
                'valor' => $request->valor,
                'estado' => $request->estado
            ];  
                $media = Edificio::create($datosEdificio);
            } catch(Exception $e){
                "";
            }
            return view('edificios.create', ['value' => true]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $edificio = Edificio::find($id);
        $pisos = Piso::where('id_edificio', $id)->get();
        return view('edificios.show', compact('edificio', 'pisos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edificio = Edificio::find($id);
        return view('edificios.edit', compact('edificio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $edificio = Edificio::find($id);
        try{ 
            $datosEdificio = [
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'postal' =>$request->postal,
                'valor' => $request->valor,
                'estado' => $request->estado
            ];
            $edificio->update($datosEdificio);
            $edificios = Edificio::get();
            return redirect()->route('edificios.index', ['edit_succes' => true, 'delete_succes' => false, 'edificios' => $edificios]);
        } catch(Exception $e){
            return response()->json(['error' => 'Error al actualizar el registro'], 501);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $edificio = Edificio::find($id);
        $edificio->delete();
        $edificios = Edificio::get();
        return redirect()->route('edificios.index', ['edit_succes' => false, 'delete_succes' => true, 'edificios' => $edificios]);


        $edificio->delete();
        return response()->json(['message' => 'Registro Eliminado!'], 200);
    }


}
