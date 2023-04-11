<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExtrasEntradasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $extras_entradas = [
            ['extras_id'=> 1,'entradas_id'=>1],
            ['extras_id'=> 2,'entradas_id'=>1],
            ['extras_id'=> 3,'entradas_id'=>2],
            ['extras_id'=> 3,'entradas_id'=>2],
        ];
        
        DB::table('extras_entradas')->insert($extras_entradas);
    }
}
