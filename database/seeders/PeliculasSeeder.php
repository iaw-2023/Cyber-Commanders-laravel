<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelicula;
use App\Models\Funcion;

class PeliculasSeeder extends Seeder
{
  
    public function run(): void
    {
        Pelicula::factory(20)
            ->has(Funcion::factory()->count(3),'funciones')
            ->create();
          
    }

}
