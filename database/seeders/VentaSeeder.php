<?php

namespace Database\Seeders;

use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Venta::create([
            'id_cliente' => 1,
            'tipo_comprobante' => 'RFC',
            'num_comprobante' => '7636820331',
            'fecha_hora' => Carbon::now()->toDateTimeString(),
            'impuesto' => 16,
            'total_venta' => 500.00,
            'estatus' => 'Activo'
        ]);

        Venta::create([
            'id_cliente' => 2,
            'tipo_comprobante' => 'INE',
            'num_comprobante' => '5639870638',
            'fecha_hora' => Carbon::now()->toDateTimeString(),
            'impuesto' => 16,
            'total_venta' => 250.00,
            'estatus' => 'Activo'
        ]);
    }
}
