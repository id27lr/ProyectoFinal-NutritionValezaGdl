<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            'categoria' => 'Proteínas',
            'descripcion' => 'Proteínas esenciales para alcanzar tus metas de salud y rendimiento.',
            'estatus' => 1
        ]);
        Categoria::create([
            'categoria' => 'Creatina',
            'descripcion' => 'Proteínas esenciales para alcanzar tus metas de salud y rendimiento.',
            'estatus' => 1
        ]);
    }
}
