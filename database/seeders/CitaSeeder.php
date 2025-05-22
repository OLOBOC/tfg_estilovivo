<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitaSeeder extends Seeder
{
    public function run(): void
    {
        $peluqueros = User::where('role', 'peluquero')->pluck('id');
        $clientes = User::where('role', 'cliente')->pluck('id');

        foreach ($clientes as $clienteId) {
            for ($i = 0; $i < rand(1, 2); $i++) {
                Cita::create([
                    'user_id' => $clienteId,
                    'peluquero_id' => $peluqueros->random(),
                    'fecha' => now()->addDays(rand(1, 10))->format('Y-m-d'),
                    'hora' => rand(9, 17) . ':00',
                ]);
            }
        }
    }
}
