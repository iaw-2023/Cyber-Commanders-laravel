<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sala;
use App\Http\Requests\SalaStoreRequest;
use App\Http\Requests\SalaUpdateRequest;

class SalasController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salas = Sala::all();
        return view('vistas.salas')->with(compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vistas.crear_sala');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalaStoreRequest $request)
    {
        $sala = new Sala();
        $sala->nombre = $request->nombre;
        $sala->capacidad = $request->capacidad;
        $sala->tipo = $request->tipo;
        $sala->save();
        return redirect()->route('salas')->with('exito', 'Sala creada correctamente!');
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
        $sala = Sala::findOrFail($id);
        return view('vistas.editar_sala')->with(compact('sala','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalaUpdateRequest $request, string $id)
    {
        $sala = Sala::findOrFail($id);
        $sala->nombre = $request->nombre;
        $sala->capacidad = $request->capacidad;
        $sala->tipo = $request->tipo;
        $sala->save();
        return redirect()->route('salas')->with('exito', 'Sala editada correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sala = Sala::findOrFail($id);
        $sala->delete();
        return redirect()->back()->with('exito', 'Sala eliminada correctamente!');   
    }

}
