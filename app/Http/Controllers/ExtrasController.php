<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Extra;
use App\Http\Requests\ExtraStoreRequest;
use App\Http\Requests\ExtraUpdateRequest;


class ExtrasController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extras = Extra::all();
        return view('vistas.extras')->with(compact('extras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vistas.crear_extra');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExtraStoreRequest $request)
    {
        $extra = new Extra();
        $extra->producto = $request->producto;
        $extra->tamaño = $request->tamaño;
        $extra->precio = $request->precio;
        $extra->save();
        return redirect()->route('extras')->with('message', 'Extra creado correctamente!');
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
        $extra= Extra::findOrFail($id);
        return view('vistas.editar_extra')->with(compact('extra','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExtraUpdateRequest $request, string $id)
    {
        $extra = Extra::findOrFail($id);
        $extra->producto = $request->producto;
        $extra->tamaño = $request->tamaño;
        $extra->precio = $request->precio;
        $extra->save();
        return redirect()->route('extras')->with('message', 'Extra editado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $extra = Extra::findOrFail($id);
        $extra->delete();
        return redirect()->back()->with('message', 'Extra eliminado correctamente!'); 
    }

}
