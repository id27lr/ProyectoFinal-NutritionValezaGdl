<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        // Crear permisos
        Permission::create(['name' => 'asignar roles']);  // Permiso para asignar roles

        // Asignar permisos a roles
        $admin->givePermissionTo(Permission::all()); // El admin tiene todos los permisos
    }
}
