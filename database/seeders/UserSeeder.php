<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Ian Daniel López Ríos',
            'email' => 'ian.lopez7601@alumnos.udg.mx',
            'password' => bcrypt('12345678')
        ])->assignRole('admin');
        
        User::create([
            'name' => 'Roberto López López',
            'email' => 'roberto.lopez9109@alumnos.udg.mx',
            'password' => bcrypt('12345678')
        ])->assignRole('admin');
        
        User::create([
            'name' => 'usuario',
            'email' => 'usuario@gmai.com',
            'password' => bcrypt('12345678')
        ])->assignRole('user');

    }
}
