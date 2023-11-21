<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Models\ContratoBienes;
use App\Models\Edificio;
use App\Models\Piso;
use App\Models\Local;
use App\Models\Inquilino;


class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contratos = Contrato::get();
        return view('contratos.index', 
                    compact('contratos'), 
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
        $pisos = Piso::where('estado', 1)->get();
        $locales = Local::where('estado', 1)->get();
        $inquilinos = Inquilino::get();

        return view('contratos.create', compact('edificios','pisos','locales','inquilinos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $datosContrato = [
                'id_inquilino' => $request->id_inquilino,
                'valor_total_mensual' => 0,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'estado' => $request->estado
            ];  
            $contrato = Contrato::create($datosContrato);
            $localesArray = $request->input('local');
            $PisosArray = $request->input('piso');
            $edificioArray = $request->input('edificio');
            
            $totalEdificio = $this->calcularTotalEdificios($edificioArray, $contrato->id);
            $totalPisos = $this->calcularTotalPisos($PisosArray, $contrato->id);
            $totalLocal = $this->calcularTotalLocal($localesArray, $contrato->id);
    
            $total = $totalEdificio + $totalLocal + $totalPisos;
            $datosContrato = [
                'valor_total_mensual' => $total
            ];
            $contrato->update($datosContrato);
            $edificios = Edificio::where('estado', 1)->get();
            $pisos = Piso::where('estado', 1)->get();
            $locales = Local::where('estado', 1)->get();
            $inquilinos = Inquilino::get();
            return view('contratos.create', ['value' => true],compact('edificios','pisos','locales','inquilinos'));
        } catch(Exception $e){
            return response()->json(['error' => 'Error al crear el registro'], 501);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contrato = Contrato::find($id);
        $inquilino = Inquilino::find($contrato->id_inquilino);
        $contratoBienes = ContratoBienes::where('id_contrato', $contrato->id)->get();
        $contratoBienes->load('edificio');
        $contratoBienes->load('local');
        $contratoBienes->load('piso');
        return view('contratos.show',compact('contrato','inquilino','contratoBienes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contrato = Contrato::find($id);
        return view('contratos.edit', compact('contrato'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contrato = Contrato::find($id);
        try{ 
            $datosContrato = [
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'estado' => $request->estado
            ];  
            $contrato->update($datosContrato);
            $contratos = Contrato::get();
            return redirect()->route('contratos.index', ['edit_succes' => true, 'delete_succes' => false, 'contratos' => $contratos]);
        } catch(Exception $e){
            return response()->json(['error' => 'Error al actualizar el registro'], 501);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contrato = Contrato::find($id);
        $contratoBienes = ContratoBienes::where('id_contrato', $contrato->id)->get();
        foreach ($contratoBienes as $bien) {
            $bien->delete();
        }
        $contrato->delete();
        $contratos = Contrato::get();
        return redirect()->route('contratos.index', ['edit_succes' => false, 'delete_succes' => true, 'contratos' => $contratos]);
    }

    public function calcularTotalEdificios($edificiosIds, $idContrato){
        $total = 0;
       if(!empty($edificiosIds)){
        foreach($edificiosIds as $id){
            $edificio = Edificio::find($id);
            $datosContratoBienes = [
                'id_contrato' => $idContrato,
                'id_edificio' => $edificio->id,
                'id_piso' => null,
                'id_local' => null
            ]; 
            $contraBien = ContratoBienes::create($datosContratoBienes);
            $total = $total + $edificio->valor;
        }
       }
        return $total;
    }

    public function calcularTotalLocal($localIds, $idContrato){
        $total = 0;
       if(!empty($localIds)){
        foreach($localIds as $id){
            $local = Local::find($id);
            $datosContratoBienes = [
                'id_contrato' => $idContrato,
                'id_edificio' => null,
                'id_piso' => null,
                'id_local' => $local->id
            ]; 
            $contraBien = ContratoBienes::create($datosContratoBienes);
            $total = $total + $local->valor;
        }
       }
        return $total;
    }

    public function calcularTotalPisos($pisosIds, $idContrato){
        $total = 0;
       if(!empty($pisosIds)){
        foreach($pisosIds as $id){
            $piso = Piso::find($id);
            $datosContratoBienes = [
                'id_contrato' => $idContrato,
                'id_edificio' => null,
                'id_piso' => $piso->id,
                'id_local' => null
            ]; 
            $contraBien = ContratoBienes::create($datosContratoBienes);
            $total = $total + $piso->valor;
        }
       }
        return $total;
    }
}
