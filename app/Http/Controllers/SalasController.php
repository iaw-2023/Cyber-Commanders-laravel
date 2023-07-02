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
 * @return \Illuminate\Http\Response
 *
 * @OA\Get(
 *     path="/rest/salas",
 *     tags={"salas"},
 *     summary="Mostrar las salas",
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
        return Sala::all()->makeVisible(['id']);;
    }

    public function index()
    {
        $salas = Sala::all();
        return view('vistas.salas')->with(compact('salas'));
    }

   
    public function create()
    {
        return view('vistas.crear_sala');
    }

    
    public function store(SalaStoreRequest $request)
    {
        $sala = new Sala();
        $sala->nombre = $request->nombre;
        $sala->capacidad = $request->capacidad;
        $sala->tipo = $request->tipo;
        $sala->save();
        return redirect()->route('salas')->with('exito', 'Sala creada correctamente!');
    }

   
    public function edit(string $id)
    {
        $sala = Sala::findOrFail($id);
        return view('vistas.editar_sala')->with(compact('sala','id'));
    }

  
    public function update(SalaUpdateRequest $request, string $id)
    {
        $sala = Sala::findOrFail($id);
        $sala->nombre = $request->nombre;
        $sala->capacidad = $request->capacidad;
        $sala->tipo = $request->tipo;
        $sala->save();
        return redirect()->route('salas')->with('exito', 'Sala editada correctamente!');
    }

   
    public function destroy(string $id)
    {
        $sala = Sala::findOrFail($id);
        $sala->delete();
        return redirect()->back()->with('exito', 'Sala eliminada correctamente!');   
    }

}
