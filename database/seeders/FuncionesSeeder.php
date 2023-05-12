<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Sala;
use App\Models\Pelicula;
use App\Models\Funcion;


class FuncionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i < 30; $i++){
            for($j=0; $j < 4; $j++){
                $pelicula = Pelicula::all()->random();
                $fecha = Carbon::today()->addDays($i)->addHours(12+ (3*$j));
                $fin = Carbon::today()->addDays($i)->addHours(12+ (3*$j))->addMinutes($pelicula->duracion); 
                $funcion = new Funcion();
                $funcion->precio = 100*rand(6,12);
                $funcion->fecha = $fecha;
                $funcion->fin = $fin;
                $funcion->sala_id = Sala::all()->random()->id;
                $funcion->pelicula_id = $pelicula->id;
                $funcion->save();
            }
        }
    }
}
