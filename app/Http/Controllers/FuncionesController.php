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

class FuncionesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     * @OA\Get(
     *      path="/funciones",
     *      tags="Funciones",
     *      summary="Retorna las funciones existentes."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function index()
    {
        $peliculas = Pelicula::all();
        $funciones = Funcion::orderBy('fecha', 'desc')->paginate(6);
        return view('vistas.funciones')->with(compact('funciones','peliculas'));
    }


    /**
     * @OA\Post(
     *      path="/funciones",
     *      tags="Funciones",
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
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


    /**
     * Show the form for creating a new resource.
     * @OA\Get(
     *      path="/crear_funcion",
     *      tags="Funciones",
     *      summary="Crea una función con sus respectivos detalles."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function create()
    {
        $peliculas = Pelicula::all();
        $salas =  Sala::all();
        return view('vistas.crear_funcion')->with(compact('peliculas','salas'));
    }

    /**
     * Store a newly created resource in storage.
     * @OA\Post(
     *      path="store_funcion",
     *      tags="Funciones",
     *      summary="Guarda una funcion creada con sus respectivos detalles."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     * @OA\Get(
     *      path="/editar_funcion/{id}",
     *      tags="Funciones",
     *      summary="Obtiene una funcion por id y permite editarla."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function edit(string $id)
    {
       $funcion = Funcion::findOrFail($id);
       $peliculas = Pelicula::all();
       $salas = Sala::all();
       
       return view('vistas.editar_funcion')->with(compact('funcion','peliculas','salas'));
    }

    /**
     * Update the specified resource in storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     * @OA\Post(
     *      path="update_funcion/{id}",
     *      tags="Funciones",
     *      summary="Obtiene una funcion por id y permite actualizarla."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
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

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     * @OA\Delete(
     *      path="destroy_funcion/{id}",
     *      tags="Funciones",
     *      summary="Busca una funcion por id y permite eliminarla."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function destroy(string $id)
    {
        $funcion = Funcion::findOrFail($id);
        $funcion->delete();
        return redirect()->back()->with('message', 'Funcion eliminada correctamente!');   

    }

}
