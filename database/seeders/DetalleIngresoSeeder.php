<?php

namespace Database\Seeders;

use App\Models\DetalleIngreso;
use App\Models\Ingreso;
use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetalleIngresoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los ingresos generados
        $ingresos = Ingreso::all();

        // Iterar sobre cada ingreso para asignar detalles
        foreach ($ingresos as $ingreso) {
            // Crear entre 1 y 3 detalles por ingreso
            for ($i = 0; $i < rand(1, 5); $i++) {
                DetalleIngreso::create([
                    'id_ingreso' => $ingreso->id, // Relacionar con el ingreso
                    'id_producto' => Producto::inRandomOrder()->first()->id, // Obtener un producto aleatorio
                    'cantidad' => rand(1, 10), // Generar una cantidad aleatoria
                    'precio_compra' => rand(50, 300) / 10, // Precio de compra entre 5.0 y 30.0
                    'precio_venta' => rand(60, 400) / 10, // Precio de venta entre 6.0 y 40.0
                ]);
            }
        }
    }
}
