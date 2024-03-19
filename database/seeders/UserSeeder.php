<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(20)
        ->create();

        $adminPelis = new User();
        $adminPelis->name = "adminPelis";
        $adminPelis->email = "adminPelis@gmail.com";
        $adminPelis->email_verified_at = now();
        $adminPelis->password = bcrypt('adminPelis');
        $adminPelis->assignRole('adminFuncionesPeliculas');
        $adminPelis->save();

        $adminSalas = new User();
        $adminSalas->name = "adminSalas";
        $adminSalas->email = "adminSalas@gmail.com";
        $adminSalas->email_verified_at = now();
        $adminSalas->password = bcrypt('adminSalas');
        $adminSalas->assignRole('adminSalas');
        $adminSalas->save();

        $adminExtras = new User();
        $adminExtras->name = "adminExtras";
        $adminExtras->email = "adminExtras@gmail.com";
        $adminExtras->email_verified_at = now();
        $adminExtras->password = bcrypt('adminExtras');
        $adminExtras->assignRole('adminCandyBar');
        $adminExtras->save();

        $superAdmin = new User();
        $superAdmin->name = "superAdmin";
        $superAdmin->email = "superAdmin@gmail.com";
        $superAdmin->email_verified_at = now();
        $superAdmin->password = bcrypt('superAdmin');
        $superAdmin->assignRole('superAdmin');
        $superAdmin->save(); 
    }
}
