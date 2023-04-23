<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class FuncionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $fecha1 = Carbon::createFromFormat('Y-m-d H', '2023-04-21 22')->toDateTimeString(); // 1975-05-21 22:00:00
        $fecha2 = Carbon::createFromFormat('Y-m-d H', '2023-04-22 22')->toDateTimeString(); // 1975-05-21 22:00:00
        $fecha3 = Carbon::createFromFormat('Y-m-d H', '2023-04-23 22')->toDateTimeString(); // 1975-05-21 22:00:00


        $funciones = [
            ['fecha'=> $fecha1,'precio'=>800, 'pelicula_id' => 1,'sala_id'=> 1],
            ['fecha'=> $fecha2,'precio'=>800,'pelicula_id' => 2,'sala_id'=> 3],
            ['fecha'=> $fecha2,'precio'=>1200,'pelicula_id' => 3,'sala_id'=> 2],
            ['fecha'=> $fecha3,'precio'=>1200,'pelicula_id' => 3,'sala_id'=> 2],
        ];
        
        DB::table('funciones')->insert($funciones);

    }
}
