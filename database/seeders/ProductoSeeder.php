<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::create([
            'id_categoria' => 1,
            'codigo' => '12345',
            'Nombre' => 'Suplemento De Calostro Bovino Advance Nutrition',
            'stock' => 10,
            'descripcion' => 'Promueve la mejora de la salud intestinal y apoyo nutricional, promueve la recuperación muscular después del ejercicio intenso, así como mejorar el rendimiento físico y resistencia.',
            'imagen' => 'storage/productos/proteina-1.jpg',
            'estatus' => 'Activo'
        ]);
        
        Producto::create([
            'id_categoria' => 1,
            'codigo' => '23456',
            'Nombre' => 'Proteína Hydrotein Vainilla Canela 5 Lbs Advance Nutrition',
            'stock' => 16,
            'descripcion' => 'Promueve la mejora de la síntesis de proteínas musculares y acelera la recuperación después del ejercicio.',
            'imagen' => 'storage/productos/proteina-2.jpg',
            'estatus' => 'Activo'
        ]);
        
        Producto::create([
            'id_categoria' => 2,
            'codigo' => '34567',
            'Nombre' => 'Creatina Monohidratada 500 G 100 Servicios Advance Nutrition',
            'stock' => 8,
            'descripcion' => 'Mejora el rendimiento físico en entrenamientos intensos. Acelera la recuperación muscular tras cada sesión. Aumenta la resistencia en ejercicios de fuerza y potencia.',
            'imagen' => 'storage/productos/creatina-1.jpg',
            'estatus' => 'Activo'
        ]);
        
        Producto::create([
            'id_categoria' => 2,
            'codigo' => '45678',
            'Nombre' => 'Creatina Monohidratada En Polvo Red Gold Sabor Natural 500 G',
            'stock' => 14,
            'descripcion' => 'Sin descripción',
            'imagen' => 'imagenes/productos/creatina-2.jpg',
            'estatus' => 'Activo'
        ]);
    }
}
