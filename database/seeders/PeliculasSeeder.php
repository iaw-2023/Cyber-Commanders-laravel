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
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/popular?language=en-US&page=1', [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0ZTdkZWE2MTFjZmZkNzc4MTkxNTc3ZTgwMmUxMWJmZiIsInN1YiI6IjY1ZjBlYjJmMDZmOTg0MDE2MjQyMTA5MiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.WgkXjM33U-i2ryIMQmCNt0uNyCiJZ05R4oP26SrikS4',
                'accept' => 'application/json',
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        $results = $data['results'];

        $datosFiltrados = collect($results)->map(function ($item) {
            
            $poster = file_get_contents("https://image.tmdb.org/t/p/w200/".$item['poster_path']);
            $posterBase64 = base64_encode($poster);
            return [
                'nombre' => $item['title'],
                'duracion' => random_int(60, 180),
                'poster' => $posterBase64
            ];
        })->toArray();

        DB::table('peliculas')->insert($datosFiltrados);
    }
}
