<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExtrasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $extras = [
            ['producto'=> 'Gaseosa','tamaño'=>'Grande', 'precio' => 500],
            ['producto'=> 'Gaseosa','tamaño'=>'Chico','precio' => 350],
            ['producto'=> 'Pochoclos','tamaño'=>'Grande','precio' => 600],
            ['producto'=> 'Pochoclos','tamaño'=>'Chico','precio' => 400],
        ];
        
        DB::table('extras')->insert($extras);
    }
}
