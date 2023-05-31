<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use App\Http\Requests\ExtraStoreRequest;
use App\Http\Requests\ExtraUpdateRequest;
use App\Http\Resources\ExtraResource;


class ExtrasController extends Controller
{
    /**
 * @return \Illuminate\Http\Response
 *
 * @OA\Get(
 *     path="/rest/extras",
 *     tags={"extras"},
 *     summary="Mostrar los extras",
 *     @OA\Response(
 *         response=200,
 *         description="Operacion exitosa."
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="Ha ocurrido un error."
 *     )
 * ) 
 */
    public function indexApi()
    {
        return ExtraResource::collection(Extra::all());
    }

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
