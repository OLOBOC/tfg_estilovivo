<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Database\Seeder;

class CitaSeeder extends Seeder
{
    public function run(): void
    {
        // obtener IDs
        $peluqueros = User::where('rol', 'peluquero')->pluck('id');
        $clientes = User::where('rol', 'cliente')->pluck('id');

        // citas aleatorias para cada cliente
        foreach ($clientes as $clienteId) {
            for ($i = 0; $i < rand(1, 2); $i++) {
                Cita::create([
                    'user_id' => $clienteId,
                    'peluquero_id' => $peluqueros->random(),
                    'fecha' => now()->addDays(rand(1, 10))->format('Y-m-d'),
                    'hora' => rand(9, 17) . ':00',
                    'servicio' => 'corte,lavado'
                ]);
            }
        }

        // citas específicas para omar
        $omar = User::where('email', 'omar@gmail.com')->first();

        if ($omar) {
            $servicios = ['corte', 'tinte', 'barba', 'peinado'];

            foreach ([1, 3, 5] as $diasExtra) {
                Cita::create([
                    'user_id' => $omar->id,
                    'peluquero_id' => $peluqueros->random(),
                    'fecha' => now()->addDays($diasExtra)->format('Y-m-d'),
                    'hora' => rand(10, 16) . ':00',
                    'servicio' => implode(',', collect($servicios)->random(rand(1, 3))->toArray())
                ]);
            }
        }
    }
}
