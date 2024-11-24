<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proveedor::create([
            'tipo_persona' => 'Proveedor',
            'nombre' => 'Distribuciones XYZ',
            'tipo_documento' => 'RFC',
            'num_documento' => '12345678901',
            'direccion' => 'Av. Las Palmas 123, Ciudad Empresarial',
            'telefono' => '987654321',
            'email' => 'contacto@xyz.com',
            'estatus' => 1
        ]);
        
        Proveedor::create([
            'tipo_persona' => 'Proveedor',
            'nombre' => 'Productos ABC',
            'tipo_documento' => 'DNI',
            'num_documento' => '456789123',
            'direccion' => 'Calle Ficticia 456, Zona Industrial',
            'telefono' => '912345678',
            'email' => 'ventas@abc.com',
            'estatus' => 1
        ]);
    }
}
