<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelicula;

class PeliculasController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peliculas = Pelicula::paginate(10);

        return view('vistas.peliculas')->with(compact('peliculas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('vistas.crear_pelicula');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pelicula = new Pelicula();
        $pelicula->nombre = $request->nombre;
        $pelicula->poster = $request->poster;
        $pelicula->duracion = $request->duracion;
        $pelicula->save();
        return redirect()->route('peliculas')->with('message', 'Pelicula creada correctamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pelicula = Pelicula::findOrFail($id);
        return view('vistas.editar_pelicula')->with(compact('pelicula'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelicula = Pelicula::findOrFail($id);
        $pelicula->nombre = $request->nombre;
        $pelicula->poster = $request->poster;
        $pelicula->duracion = $request->duracion;
        $pelicula->save();
        return redirect()->route('peliculas')->with('message', 'Pelicula editada correctamente!');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelicula = Pelicula::findOrFail($id);
        $pelicula->delete();
        return redirect()->back()->with('message', 'Pelicula eliminada correctamente!');   
    }

}