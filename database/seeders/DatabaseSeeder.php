<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(CategoriaSeeder::class);
        $this->call(ProductoSeeder::class);

        $this->call(ProveedorSeeder::class);
        $this->call(CLienteSeeder::class);
        
        $this->call(IngresoSeeder::class);
        $this->call(DetalleIngresoSeeder::class);
        
        $this->call(VentaSeeder::class);
        $this->call(DetalleVentaSeeder::class);
    }
}
