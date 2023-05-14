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
     * @OA\Get(
     *      path="/extras",
     *      tags="Extras",
     *      summary="Retorna los extras existentes."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function index()
    {
        $extras = Extra::all();
        return view('vistas.extras')->with(compact('extras'));
    }

    /**
     * Show the form for creating a new resource.
     * @OA\Get(
     *      path="/crear_extra",
     *      tags="Extras",
     *      summary="Crea un extra con sus respectivos detalles."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function create()
    {
        return view('vistas.crear_extra');
    }

    /**
     * Store a newly created resource in storage.
     * @OA\Post(
     *      path="store_extra",
     *      tags="Extras",
     *      summary="Guarda un extra creado con sus respectivos detalles."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
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
     * @OA\Get(
     *      path="/editar_extra/{id}",
     *      tags="Extras",
     *      summary="Obtiene un extra por id y permite editarlo."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function edit(string $id)
    {
        $extra= Extra::findOrFail($id);
        return view('vistas.editar_extra')->with(compact('extra','id'));
    }

    /**
     * Update the specified resource in storage.
     * @OA\Post(
     *      path="update_extra/{id}",
     *      tags="Extras",
     *      summary="Obtiene un extra por id y permite actualizarlo."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
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
     * @OA\Delete(
     *      path="destroy_extra/{id}",
     *      tags="Extras",
     *      summary="Busca un extra por id y permite eliminarlo."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function destroy(string $id)
    {
        $extra = Extra::findOrFail($id);
        $extra->delete();
        return redirect()->back()->with('message', 'Extra eliminado correctamente!'); 
    }

}
