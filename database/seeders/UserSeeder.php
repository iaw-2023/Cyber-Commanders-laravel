<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hashedpassword = bcrypt('admin');
        
        DB::table('users')->insert([
            'nombre' => "admin",
            'email' => 'admin@gmail.com',
            'password' => $hashedpassword ,
        ]);
    }
}
