<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use App\Http\Requests\ExtraStoreRequest;
use App\Http\Requests\ExtraUpdateRequest;


class ExtrasController extends Controller
{
    

    public function index()
    {
        $extras = Extra::all();
        return view('vistas.extras')->with(compact('extras'));
    }

    public function create()
    {
        return view('vistas.crear_extra');
    }

   
    public function store(ExtraStoreRequest $request)
    {
        $extra = new Extra();
        $extra->producto = $request->producto;
        $extra->tamaño = $request->tamaño;
        $extra->precio = $request->precio;
        $extra->save();
        return redirect()->route('extras')->with('message', 'Extra creado correctamente!');
    }

   
    public function show(string $id)
    {
        //
    }

   
    public function edit(string $id)
    {
        $extra= Extra::findOrFail($id);
        return view('vistas.editar_extra')->with(compact('extra','id'));
    }

   
    public function update(ExtraUpdateRequest $request, string $id)
    {
        $extra = Extra::findOrFail($id);
        $extra->producto = $request->producto;
        $extra->tamaño = $request->tamaño;
        $extra->precio = $request->precio;
        $extra->save();
        return redirect()->route('extras')->with('message', 'Extra editado correctamente!');
    }

   
    public function destroy(string $id)
    {
        $extra = Extra::findOrFail($id);
        $extra->delete();
        return redirect()->back()->with('message', 'Extra eliminado correctamente!'); 
    }

}
