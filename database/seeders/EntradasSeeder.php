<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntradasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $entradas = [
            ['funcion_id'=> 1],
            ['funcion_id'=> 1],
            ['funcion_id'=> 1],
            ['funcion_id'=> 2],
        ];
        
        DB::table('entradas')->insert($entradas);
    }
}
