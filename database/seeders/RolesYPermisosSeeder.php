<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesYPermisosSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'crear sala']);
        Permission::create(['name' => 'editar sala']);
        Permission::create(['name' => 'borrar sala']);

        Permission::create(['name' => 'crear funciones y peliculas']);
        Permission::create(['name' => 'editar funciones y peliculas']);
        Permission::create(['name' => 'borrar funciones y peliculas']);
        
        Permission::create(['name' => 'crear extra']);
        Permission::create(['name' => 'editar extra']);
        Permission::create(['name' => 'borrar extra']);


        // create roles and assign created permissions
        // this can be done as separate statements

        $adminSalas = Role::create(['name' => 'adminSalas']);
        $adminSalas->givePermissionTo(['crear sala', 'editar sala' ,'borrar sala']);

        $adminFuncionesPeliculas = Role::create(['name' => 'adminFuncionesPeliculas']);
        $adminFuncionesPeliculas->givePermissionTo(['crear funciones y peliculas', 'editar funciones y peliculas' ,'borrar funciones y peliculas']);

        $adminCandyBar = Role::create(['name' => 'adminCandyBar']);
        $adminCandyBar->givePermissionTo(['crear extra' , 'editar extra', 'borrar extra']);      

        $admin = Role::create(['name' => 'superAdmin']);
        $admin->givePermissionTo(Permission::all());
    }
}