<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sala;
use App\Http\Requests\SalaStoreRequest;
use App\Http\Requests\SalaUpdateRequest;


/**
 * @OA\Info(title="API Salas", version="1.0")
 * 
 * @OA\Server(url="http://swagger.local")
 */
class SalasController extends Controller
{
    
    /**
     * Display a listing of the resource.
     * @OA\Get(
     *      path="/salas",
     *      tags="Sala",
     *      summary="Retorna las salas existentes."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function index()
    {
        $salas = Sala::all();
        return view('vistas.salas')->with(compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     * @OA\Get(
     *      path="/crear_sala",
     *      tags="Sala",
     *      summary="Crea una sala con sus respectivos detalles."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function create()
    {
        return view('vistas.crear_sala');
    }

    /**
     * Store a newly created resource in storage.
     * @OA\Post(
     *      path="store_sala",
     *      tags="Sala",
     *      summary="Guarda una sala creada con sus respectivos detalles."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
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
     * @OA\Get(
     *      path="/editar_sala/{id}",
     *      tags="Sala",
     *      summary="Obtiene una sala por id y permite editarla."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function edit(string $id)
    {
        $sala = Sala::findOrFail($id);
        return view('vistas.editar_sala')->with(compact('sala','id'));
    }

    /**
     * Update the specified resource in storage.
     * @OA\Post(
     *      path="uupdate_sala/{id}",
     *      tags="Sala",
     *      summary="Obtiene una sala por id y permite actualizarla."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
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
     * @OA\Delete(
     *      path="destroy_sala/{id}",
     *      tags="Sala",
     *      summary="Busca una sala por id y permite eliminarla."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function destroy(string $id)
    {
        $sala = Sala::findOrFail($id);
        $sala->delete();
        return redirect()->back()->with('exito', 'Sala eliminada correctamente!');   
    }

}
