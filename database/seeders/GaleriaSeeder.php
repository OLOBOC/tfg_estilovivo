<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GaleriaSeeder extends Seeder
{
    public function run()
    {
        // Limpia la tabla para evitar duplicados
        DB::table('galeria')->truncate();

        // Inserta los nuevos estilos con nombres actualizados
        $items = [
            [
                'imagen' => 'img/corte_undercut.jpg',
                'servicio' => 'Corte',
                'nombre_estilo' => 'Undercut moderno',
                'descripcion' => 'Corte bajo con degradado lateral y textura superior con estilo.',
            ],
            [
                'imagen' => 'img/peinado_ondas.jpg',
                'servicio' => 'Peinado',
                'nombre_estilo' => 'Ondas definidas',
                'descripcion' => 'Peinado voluminoso con ondas marcadas para un look glamuroso.',
            ],
            [
                'imagen' => 'img/tinte_cobrizo.jpg',
                'servicio' => 'Tinte',
                'nombre_estilo' => 'Rojo cobrizo',
                'descripcion' => 'Color vivo con acabado brillante que resalta en cualquier luz.',
            ],
            [
                'imagen' => 'img/corte_fade.jpg',
                'servicio' => 'Corte',
                'nombre_estilo' => 'Fade clásico',
                'descripcion' => 'Estilo limpio con líneas definidas y degradado perfecto.',
            ],
            [
                'imagen' => 'img/tinte_rubio.jpg',
                'servicio' => 'Tinte',
                'nombre_estilo' => 'Rubio ceniza',
                'descripcion' => 'Matiz frío que aporta elegancia y sofisticación.',
            ],
            [
                'imagen' => 'img/recogido_elegante.jpg',
                'servicio' => 'Peinado',
                'nombre_estilo' => 'Moño bajo elegante',
                'descripcion' => 'Recogido ideal para bodas o eventos formales con acabado pulido.',
            ],
        ];

        DB::table('galeria')->insert($items);
    }
}
