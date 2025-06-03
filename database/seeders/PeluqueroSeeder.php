<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PeluqueroSeeder extends Seeder
{
    public function run(): void
    {
        // peluqueros
        User::create([
            'name' => 'Carlos Pérez',
            'email' => 'carlos@estilovivo.com',
            'password' => Hash::make('password'),
            'rol' => 'peluquero',
        ]);

        User::create([
            'name' => 'Laura García',
            'email' => 'laura@estilovivo.com',
            'password' => Hash::make('password'),
            'rol' => 'peluquero',
        ]);

        User::create([
            'name' => 'Andrés Martínez',
            'email' => 'andres@estilovivo.com',
            'password' => Hash::make('password'),
            'rol' => 'peluquero',
        ]);

        // clientes
        User::create([
            'name' => 'Omar',
            'email' => 'omar@gmail.com',
            'password' => Hash::make('12345678'),
            'rol' => 'cliente',
        ]);

      
    }
}
