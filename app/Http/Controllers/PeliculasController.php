<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PeliculaResource;
use App\Models\Pelicula;
use App\Http\Requests\PeliculaStoreRequest;
use App\Http\Requests\PeliculaUpdateRequest;
use Symfony\Component\HttpFoundation\Response;


class PeliculasController extends Controller
{
    
/**
 * @return \Illuminate\Http\Response
 *
 * @OA\Get(
 *     path="/rest/peliculas",
 *     tags={"peliculas"},
 *     summary="Mostrar todas las peliculas",
 *     @OA\Response(
 *         response=200,
 *         description="Operación exitosa."
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="Ha ocurrido un error."
 *     )
 * ) 
 */
public function indexApi()
{
    return PeliculaResource::collection(Pelicula::all());
}

/**
 * @return \Illuminate\Http\Response
 *
 * @OA\Get(
 *     path="/rest/peliculasPorNombre",
 *     tags={"peliculas"},
 *     summary="Coleccion de los nombres de las peliculas",
 *     @OA\Response(
 *         response=200,
 *         description="Operación exitosa."
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="Ha ocurrido un error."
 *     )
 * ) 
 */
public function getMovieNames()
{
    return Pelicula::get('nombre')->toArray();
}


/**
 * @param string $nombre
 * @return \Illuminate\Http\Response
 *
 * @OA\Get(
 *     path="/rest/peliculas/{nombre}",
 *     tags={"peliculas"},
 *     summary="Buscar una pelicula por nombre",
 *     @OA\Parameter(
 *         name="nombre",
 *         in="path",
 *         description="Nombre de la película a buscar",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Operación exitosa."
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="Ha ocurrido un error."
 *     )
 * )
 */
public function buscarPorNombre($nombre)
{
    $pelicula = Pelicula::where('nombre', $nombre)->first();

    if (!$pelicula) {
        return response()->json(['error' => 'La película no fue encontrada'], Response::HTTP_NOT_FOUND);
    }

    // Si se encuentra la película, puedes devolverla como lo harías normalmente
    return new PeliculaResource($pelicula);
}

    public function index()
    {
        $peliculas = Pelicula::paginate(10);

        return view('vistas.peliculas')->with(compact('peliculas'));
    }


    public function create()
    {

        return view('vistas.crear_pelicula');
    }


    public function store(PeliculaStoreRequest $request)
    {
        $pelicula = new Pelicula();
        $pelicula->nombre = $request->nombre;
        $pelicula->duracion = $request->duracion;
        $pelicula->poster = base64_encode(file_get_contents($request->file('poster')->getRealPath()));
        $pelicula->save();
        
        return redirect()->route('peliculas')->with('message', 'Pelicula creada correctamente!');
    }

    public function show(string $id)
    {
        $pelicula = Pelicula::findOrFail($id);
        return view('vistas.mostrar_pelicula')->with(compact('pelicula'));
    }


    public function edit(string $id)
    {
        $pelicula = Pelicula::findOrFail($id);
        return view('vistas.editar_pelicula')->with(compact('pelicula'));
    }


    public function update(PeliculaUpdateRequest $request, string $id)
    {
        
        $pelicula = Pelicula::findOrFail($id);
        $pelicula->nombre = $request->nombre;
        $pelicula->duracion = $request->duracion;
        if($request->poster!=null)
            $pelicula->poster = base64_encode(file_get_contents($request->file('poster')->getRealPath()));
        $pelicula->save();
        return redirect()->route('peliculas')->with('exito', 'Pelicula editada correctamente!');
        //
    }


    public function destroy(string $id)
    {
        $pelicula = Pelicula::findOrFail($id);
        $pelicula->delete();
        return redirect()->route('peliculas')->with('exito', 'Pelicula eliminada correctamente!');
    }
}
