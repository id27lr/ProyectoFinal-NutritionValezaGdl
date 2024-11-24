<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create([
            'tipo_persona' => 'Cliente',
            'nombre' => 'Juan Pérez',
            'tipo_documento' => 'RFC',
            'num_documento' => '789456123',
            'direccion' => 'Calle de la Paz 45, Piso 2, Ciudad Central',
            'telefono' => '987654321',
            'email' => 'juan.perez@email.com',
            'estatus' => 1
        ]);
        
        Cliente::create([
            'tipo_persona' => 'Cliente',
            'nombre' => 'María Gómez',
            'tipo_documento' => 'RFC',
            'num_documento' => '123789456',
            'direccion' => 'Avenida Libertad 88, Dep. 3, Barrio Nuevo',
            'telefono' => '912345678',
            'email' => 'maria.gomez@email.com',
            'estatus' => 1
        ]);
    }
}
