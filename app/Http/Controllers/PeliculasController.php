<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Funcion;
use App\Http\Requests\PeliculaStoreRequest;
use App\Http\Requests\PeliculaUpdateRequest;


class PeliculasController extends Controller
{
    
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
        $pelicula->poster = $request->poster;

        $pelicula->save();
        return redirect()->route('peliculas')->with('message', 'Pelicula creada correctamente!');
    }

    public function show(string $id)
    {
        $pelicula = Pelicula::findOrFail($id);
        return view('vistas.mostrar_pelicula')->with(compact('pelicula'));
    }

    public function showFunciones(string $id)
    {
        $funciones = Funcion::where('pelicula_id',$id)->paginate(6);;
        return view('vistas.mostrar_funciones_pelicula')->with(compact('funciones'));
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
        $pelicula->poster = $request->poster;
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
