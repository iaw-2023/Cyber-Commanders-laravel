<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesYPermisosSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SalasSeeder::class);
        $this->call(PeliculasSeeder::class);
        $this->call(FuncionesSeeder::class);
        $this->call(ExtrasSeeder::class);
        $this->call(EntradasSeeder::class);
        $this->call(ExtrasEntradasSeeder::class);
    }
}
