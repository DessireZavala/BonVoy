<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContenidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
// 1. Un Destino (Zacatecas)
    $zac = \App\Models\Contenido::create([
        'titulo' => 'Zacatecas Centro',
        'descripcion' => 'Ciudad colonial con museos y leyendas.',
        'tipo' => 'destino',
        'activo' => true
    ]);

    // 2. Un Hospedaje
    \App\Models\Contenido::create([
        'titulo' => 'Hotel Don Miguel',
        'descripcion' => 'Excelente ubicación con vista al acueducto.',
        'tipo' => 'hospedaje',
        'precio' => 1800.00,
        'activo' => true
    ]);

    // 3. Tu Pase Digital (El "FastPass")
    \App\Models\Contenido::create([
        'titulo' => 'Pase Cultural Nivel 1',
        'descripcion' => 'Entrada sin filas a Museo de la Inquisición, Máscaras y Goytia.',
        'tipo' => 'pase',
        'precio' => 450.00,
        'activo' => true
    ]);    }
}
