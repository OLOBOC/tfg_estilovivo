<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        // usuario peluquero
        User::create([
            'name' => 'Laura Estilista',
            'email' => 'peluquera@estilovivo.com',
            'password' => Hash::make('12345678'),
            'rol' => 'peluquero',
        ]);
        User::create([
            'name' => 'pepe peluquero',
            'email' => 'pepe@gmail.com',
            'password' => Hash::make('1234567'),
            'rol' => 'peluquero',
        ]);
        // usuario cliente
        User::create([
            'name' => 'Carlos Cliente',
            'email' => 'cliente@estilovivo.com',
            'password' => Hash::make('12345678'),
            'rol' => 'cliente',
        ]);
        User::create([
            'name' => 'omar',
            'email' => 'omar@gmail.com',
            'password' => Hash::make('12345678'),
            'rol' => 'cliente',
        ]);
    }
}

