<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Funcion;
use App\Models\Entrada;
use App\Http\Requests\EntradaStoreRequest;


class EntradasController extends Controller
{
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
 *     path="/rest/storeEntrada",
 *     description="Guarda una nueva entrada asociada a una funcion y ciertos productos. Para agregar elementos al arreglo de extras se debe copiar y pegar el contenido encerrado por llaves",
 *     summary="Crear una nueva entrada",
 *     tags={"entradas"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *           @OA\Property(property="funcion_id", type="integer"),
 *           @OA\Property(
 *              property="extras",
 *               type="array",
 *               @OA\Items(
 *                  @OA\Property(property="id", type="integer"),
 *                  @OA\Property(property="cantidad", type="integer")
 *              )
 *          ),
 *             )
 *          )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Operacion exitosa",
 *         @OA\MediaType(
 *             mediaType="application/json"
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error: Unprocessable Content. Algun parametro no es valido",
 *         @OA\MediaType(
 *             mediaType="application/json"
 *         )
 *     ),
 *
 * )
 */
    public function storeEntrada(EntradaStoreRequest $request)
    { 
            $entrada = new Entrada();
            $funcion = Funcion::findOrFail($request->funcion_id);
            $entrada->funcion_id = $funcion->id;
            $extras = $request->extras;
            $entrada-> save();
            foreach($extras as $extra){
               $entrada->extras()->attach($extra['id'], ['cantidad' => $extra['cantidad']]);
            }
            return response()->json(['success'=>'true','message' => 'Operacion Exitosa.'], 200);
    }
}
