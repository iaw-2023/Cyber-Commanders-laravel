<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $salas = [
            ['capacidad'=> 80,'tipo'=>'comun', 'nombre' => 'sala comun'],
            ['capacidad'=> 65,'tipo'=>'3d','nombre' => 'sala 3d'],
            ['capacidad'=> 100,'tipo'=>'comun','nombre' => 'sala comun 2'],
        ];
        
        DB::table('salas')->insert($salas);
    }
}
