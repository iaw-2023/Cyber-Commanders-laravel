<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Http\Requests\PeliculaStoreRequest;
use App\Http\Requests\PeliculaUpdateRequest;


/**
 * @OA\Info(title="API Peliculas", version="1.0")
 * 
 * @OA\Server(url="http://swagger.local")
 */
class PeliculasController extends Controller
{
    
    /**
     * Display a listing of the resource.
     * @OA\Get(
     *      path="/peliculas",
     *      tags="Pelicula",
     *      summary="Retorna las peliculas en cartelera."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function index()
    {
        $peliculas = Pelicula::paginate(10);

        return view('vistas.peliculas')->with(compact('peliculas'));
    }

    /**
     * Show the form for creating a new resource.
     * @OA\Get(
     *      path="/crear_pelicula",
     *      tags="Pelicula",
     *      summary="Crea una pelicula con sus respectivos detalles."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function create()
    {
        
        return view('vistas.crear_pelicula');
    }

    /**
     * Store a newly created resource in storage.
     *      * @OA\Post(
     *      path="store_pelicula",
     *      tags="Pelicula",
     *      summary="Guarda una pelicula creada con sus respectivos detalles."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function store(PeliculaStoreRequest $request)
    {
        $pelicula = new Pelicula();
        $pelicula->nombre = $request->nombre;
        $pelicula->duracion = $request->duracion;

        if($request->hasFile('imagen')){
            $path_destino = 'public/images';
            $imagen = $request->file('imagen');
            $nombre = $imagen->getClientOriginalName();
            $path = $imagen->storeAs($path_destino,$nombre);
        }
        $pelicula->poster = $nombre;

        $pelicula->save();
        return redirect()->route('peliculas')->with('message', 'Pelicula creada correctamente!');
    }

    /**
     * Display the specified resource.
     * @OA\Get(
     *      path="/ver_pelicula/{id}",
     *      tags="Pelicula",
     *      summary="Obtiene una pelicula por id y muestra sus respectivos detalles."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function show(string $id)
    {
        $pelicula = Pelicula::findOrFail($id);
        return view('vistas.mostrar_pelicula')->with(compact('pelicula'));
    }

    /**
     * Show the form for editing the specified resource.
     * @OA\Get(
     *      path="/editar_pelicula/{id}",
     *      tags="Pelicula",
     *      summary="Obtiene una pelicula por id y permite editarla."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function edit(string $id)
    {
        $pelicula = Pelicula::findOrFail($id);
        return view('vistas.editar_pelicula')->with(compact('pelicula'));
    }

    /**
     * Update the specified resource in storage.
     * @OA\Post(
     *      path="update_pelicula/{id}",
     *      tags="Pelicula",
     *      summary="Obtiene una pelicula por id y permite actualizarla."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function update(PeliculaUpdateRequest $request, string $id)
    {
        $pelicula = Pelicula::findOrFail($id);
        $pelicula->nombre = $request->nombre;
        $pelicula->duracion = $request->duracion;

        if($request->hasFile('imagen')){
            $path_destino = 'public/images';
            $imagen = $request->file('imagen');
            $nombre = $imagen->getClientOriginalName();
            $path = $imagen->storeAs($path_destino,$nombre);
        }
        $pelicula->poster = $nombre;
        $pelicula->save();
        return redirect()->route('peliculas')->with('exito', 'Pelicula editada correctamente!');
        //
    }

    /**
     * Remove the specified resource from storage.
     * @OA\Delete(
     *      path="destroy_pelicula/{id}",
     *      tags="Pelicula",
     *      summary="Busca una pelicula por id y permite eliminarla."
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function destroy(string $id)
    {
        $pelicula = Pelicula::findOrFail($id);
        $pelicula->delete();
        return redirect()->route('peliculas')->with('exito', 'Pelicula eliminada correctamente!');   
    }

}
