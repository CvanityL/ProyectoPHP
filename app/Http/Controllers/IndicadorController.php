<?php

namespace App\Http\Controllers;

use App\Models\Indicador;
use App\Http\Requests\StoreIndicadorRequest;
use App\Http\Requests\UpdateIndicadorRequest;
use App\Http\Requests\SearhByDateRequest;

class IndicadorController extends Controller
{
    /**
     * Return a listing of the resource.
     */
    public function index()
    {
        $listIndicadores= Indicador::all();
        return json_encode($listIndicadores);
    }

    /**
     * Return a listing of the resource filter by date.
     */
    public function searchByDate(SearhByDateRequest $request)
    {
        $fechas=$request->validated();
        $listIndicadores= Indicador::whereBetween('fechaIndicador', [$fechas['fechaDesde'], $fechas['fechaHasta']])->get();
        return json_encode($listIndicadores);
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
    public function store(StoreIndicadorRequest $request)
    {
        $data=$request->validated();
        $indicador = Indicador::create([
            'nombreIndicador' => $data['nombreIndicador'],
            'codigoIndicador' => $data['codigoIndicador'],
            'unidadMedidaIndicador' => $data['unidadMedidaIndicador'],
            'valorIndicador' => $data['valorIndicador'],
            'fechaIndicador' => $data['fechaIndicador'],
            'origenIndicador' => $data['origenIndicador'],
        ]);
        return json_encode($indicador);
    }

    /**
     * Return the specified resource.
     */
    public function show($indicador)
    {
        $dataIndicador=Indicador::find($indicador);
        return json_encode($dataIndicador);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Indicador $indicador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIndicadorRequest $request,$indicador)
    {
        $data=$request->validated();
        $dataIndicador=Indicador::find($indicador);
        $dataIndicador->nombreIndicador=$data['nombreIndicador'];
        $dataIndicador->codigoIndicador=$data['codigoIndicador'];
        $dataIndicador->unidadMedidaIndicador=$data['unidadMedidaIndicador'];
        $dataIndicador->valorIndicador=$data['valorIndicador'];
        $dataIndicador->tiempoIndicador=isset($data['tiempoIndicador'])? $data['tiempoIndicador']:null;
        $dataIndicador->nombreIndicador=$data['nombreIndicador'];
        $dataIndicador->origenIndicador=$data['origenIndicador'];
        $dataIndicador->save();
        return json_encode($dataIndicador);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($indicador)
    {
        $dataIndicador=Indicador::find($indicador);
        $dataIndicador->forceDelete();
    }
}
