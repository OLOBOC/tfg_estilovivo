<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GaleriaSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'imagen' => 'img/caballero1.jpg',
                'servicio' => 'Corte',
                'nombre_estilo' => 'Buzzcut',
                'descripcion' => 'Corte clásico con máquina, muy fresco y cómodo.',
            ],
            [
                'imagen' => 'img/seniora1.jpg',
                'servicio' => 'Peinado',
                'nombre_estilo' => 'Ondas suaves',
                'descripcion' => 'Peinado romántico para eventos y ocasiones especiales.',
            ],
            [
                'imagen' => 'img/tinte1.jpg',
                'servicio' => 'Tinte',
                'nombre_estilo' => 'Cobrizo brillante',
                'descripcion' => 'Color intenso que resalta con luz natural.',
            ],
            [
                'imagen' => 'img/caballero2.jpg',
                'servicio' => 'Corte',
                'nombre_estilo' => 'Fade con textura',
                'descripcion' => 'Corte moderno con volumen arriba y degradado lateral.',
            ],
            [
                'imagen' => 'img/seniora2.jpg',
                'servicio' => 'Tinte',
                'nombre_estilo' => 'Rubio dorado',
                'descripcion' => 'Tonos dorados que iluminan y rejuvenecen.',
            ],
            [
                'imagen' => 'img/peinado1.jpg',
                'servicio' => 'Peinado',
                'nombre_estilo' => 'Recogido boda',
                'descripcion' => 'Peinado elegante y sofisticado para novias o invitadas.',
            ],
        ];

        DB::table('galeria')->insert($items);
    }
}


