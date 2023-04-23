<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeliculasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $peliculas = [
            ['duracion'=> 175,'nombre'=>'el padrino', 'poster' => 'https://www.omdb.org/image/default/512.jpeg'],
            ['duracion'=> 200,'nombre'=>'el padrino 2', 'poster' => 'https://www.omdb.org/image/default/516.jpeg'],
            ['duracion'=> 162,'nombre'=>'el padrino 3', 'poster' => 'https://www.omdb.org/image/default/523.jpeg']
        ];
        
        DB::table('peliculas')->insert($peliculas);

    }
}
