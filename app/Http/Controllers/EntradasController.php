<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Funcion;
use App\Models\Entrada;


class EntradasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $funciones = Funcion::all();
        return view('vistas.crear_entrada')->with(compact('funciones'));
    }

/**
 * @OA\Post(
 *     path="/rest/api/storeEntrada",
 *      tags={"entradas"},
 *     summary="Agrega una entrada para una funcion",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="funcion_id",
 *                     type="int"
 *                 ),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Examples(example="result", value={"success": true}, summary="A result object."),
 *             @OA\Examples(example="bool", value=false, summary="A boolean value."),
 *         )
 *     ),
 *  @OA\Response(
 *         response="400",
 *         description="Ha ocurrido un error."
 *     )
 * )
 */
    public function storeApi(Request $request)
    {
        $entrada = new Entrada();
        $funcion = Funcion::findOrFail($request->funcion_id);
        $entrada->funcion_id = $funcion->id;
        $entrada-> save();
        return response()->json(['success' => 'success'], 200);
    }


 
    public function store(Request $request)
    {
        $entrada = new Entrada();
        $funcion = Funcion::findOrFail($request->funcion);
        $entrada-> save();
        return redirect()->route('entradas')->with('message', 'Entrada creada correctamente!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
