<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PeluqueroSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Carlos Pérez',
            'email' => 'carlos@estilovivo.com',
            'password' => Hash::make('password'),
            'role' => 'peluquero',
        ]);

        User::create([
            'name' => 'Laura García',
            'email' => 'laura@estilovivo.com',
            'password' => Hash::make('password'),
            'role' => 'peluquero',
        ]);

        User::create([
            'name' => 'Andrés Martínez',
            'email' => 'andres@estilovivo.com',
            'password' => Hash::make('password'),
            'role' => 'peluquero',
        ]);
    }
}
