<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Funcion;
use App\Models\Pelicula;
use App\Models\Sala;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\FuncionStoreRequest;
use App\Http\Requests\FuncionUpdateRequest;
use App\Http\Resources\FuncionResource;
use Illuminate\Http\Response;

class FuncionesController extends Controller
{
    
/**
 * @return \Illuminate\Http\Response
 *
 * @OA\Get(
 *     path="/rest/funciones",
 *     tags={"funciones"},
 *     summary="Mostrar las funciones",
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
        return FuncionResource::collection(Funcion::paginate());
    }


    /**
     * @OA\Get(
     *    path="/rest/funciones/pelicula/{id}",
     *    tags={"funciones/pelicula"},
     *    summary="Mostrar las funciones de una pelicula",
     *    description="Obtiene el listado de funciones de una pelicula determinada",
     *    @OA\Parameter(name="id",in="path", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *     @OA\Response(
     *          response=200, description="Operacion exitosa",
     *       ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontraron funciones para la pelicula solicitada, o la misma no existe en el sistema."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     *  )
     */
    public function indexMovieApi(int $id){
        $pelicula = Pelicula::find($id);
        if ($pelicula === null) {
            return response("Pelicula {$id} not found", Response::HTTP_NOT_FOUND);
        }
       return FuncionResource::collection($pelicula->funciones);
    }

    public function index()
    {
        $peliculas = Pelicula::all();
        $funciones = Funcion::orderBy('fecha', 'desc')->paginate(6);
        return view('vistas.funciones')->with(compact('funciones','peliculas'));
    }

    public function indexMovie(Request $request)
    {
        if($request->elegida == -1)
        {
          return $this->index();   
        }
        else{
            $id = $request->elegida;
            $peliculas = Pelicula::all();
            $pelicula = Pelicula::findOrFail($id);
            $funciones = Funcion::where('pelicula_id',$id)->orderBy('fecha', 'desc')->paginate(6);
            return view('vistas.funciones')->with(compact('funciones','pelicula','peliculas'));
        }
        
    }


    public function create()
    {
        $peliculas = Pelicula::all();
        $salas =  Sala::all();
        return view('vistas.crear_funcion')->with(compact('peliculas','salas'));
    }

  
    public function store(FuncionStoreRequest $request)
    {
        $funcion = new Funcion();
        $pelicula = Pelicula::findOrFail($request->pelicula);
        $fecha = Carbon::createFromFormat('Y-m-d\TH:i', $request->fecha); 
        $fin = Carbon::createFromFormat('Y-m-d\TH:i', $request->fecha)->addMinutes($pelicula->duracion);
        $funcion->precio = $request->precio;
        $funcion->fecha = $fecha;
        $funcion->fin = $fin;
        $funcion->sala_id = $request->sala;
        $funcion->pelicula_id = $request->pelicula;
        $funcion->save();
        return redirect()->route('funciones')->with('message', 'Funcion creada correctamente!');
    }
 
    public function edit(string $id)
    {
       $funcion = Funcion::findOrFail($id);
       $peliculas = Pelicula::all();
       $salas = Sala::all();
       
       return view('vistas.editar_funcion')->with(compact('funcion','peliculas','salas'));
    }


    public function update(FuncionUpdateRequest $request, string $id)
    {
        $funcion = Funcion::findOrFail($id);
        $pelicula = Pelicula::findOrFail($request->pelicula);
        $fecha = Carbon::createFromFormat('Y-m-d\TH:i', $request->fecha); 
        $fin = Carbon::createFromFormat('Y-m-d\TH:i', $request->fecha)->addMinutes($pelicula->duracion);
        $funcion->precio = $request->precio;
        $funcion->fecha = $fecha;
        $funcion->fin = $fin;
        $funcion->sala_id = $request->sala;
        $funcion->pelicula_id = $request->pelicula;
        $funcion->save();
        return redirect()->route('funciones')->with('message', 'Funcion editada correctamente!');
   
    }


    public function destroy(string $id)
    {
        $funcion = Funcion::findOrFail($id);
        $funcion->delete();
        return redirect()->back()->with('message', 'Funcion eliminada correctamente!');   

    }

    public function showFuncionesPorPelicula(string $id)
    {
        $funciones = Funcion::where('pelicula_id',$id)->paginate(6);
        $nombre = $funciones->first()->pelicula->nombre;  
        return view('vistas.mostrar_funciones_pelicula')->with(compact('funciones','nombre'));
    }

    public function showFuncionesPorSala(string $id)
    {
        $funciones = Funcion::where('sala_id',$id)->paginate(6);
        $nombre = $funciones->first()->sala->nombre;  
        return view('vistas.mostrar_funciones_sala')->with(compact('funciones','nombre'));
    }


}