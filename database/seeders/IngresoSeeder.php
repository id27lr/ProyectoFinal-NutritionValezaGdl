<?php

namespace Database\Seeders;

use App\Models\Ingreso;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngresoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ingreso::create([
            'id_proveedor' => 1, 
            'comprobante' => 'RFC', 
            'num_comprobante' => '4531274331', 
            'fecha_hora' => Carbon::now()->toDateTimeString(), 
            'impuesto' => 16, 
            'estatus' => 'Activo'
        ]);
        
        Ingreso::create([
            'id_proveedor' => 2, 
            'comprobante' => 'INE', 
            'num_comprobante' => '4631824331', 
            'fecha_hora' => Carbon::now()->toDateTimeString(), 
            'impuesto' => 16, 
            'estatus' => 'Activo'
        ]);
    }
}
