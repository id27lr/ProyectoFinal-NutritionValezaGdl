<?php

namespace Database\Seeders;

use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetalleVentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ventas = Venta::all();

        // Iterar sobre cada venta para asignar detalles
        foreach ($ventas as $venta) {
            // Crear entre 1 y 5 detalles por venta
            for ($i = 0; $i < rand(1, 5); $i++) {
                DetalleVenta::create([
                    'id_venta' => $venta->id, // Relacionar con la venta
                    'id_producto' => Producto::inRandomOrder()->first()->id, // Obtener un producto aleatorio
                    'cantidad' => rand(1, 10), // Generar una cantidad aleatoria
                    'precio_venta' => rand(50, 300) / 10, // Precio de venta entre 5.0 y 30.0
                    'descuento' => rand(0, 100) / 10, // Generar un descuento entre 0 y 10.0
                ]);
            }
        }
    }
}
