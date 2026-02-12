<?php

namespace Database\Seeders;

use App\Models\ResultadoAprendizaje;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use LDAP\Result;

class ResultadosAprendizajeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ResultadoAprendizaje::truncate();

        ResultadoAprendizaje::factory(10)->create();
        foreach (self::$resultados_aprendizaje as $resultado_aprendizaje) {
            ResultadoAprendizaje::insert([
                'codigo' => $resultado_aprendizaje['codigo'],
                //'modulo_formativo_id' => $resultado_aprendizaje['modulo_formativo_id'],
                'descripcion' => $resultado_aprendizaje['descripcion'],
                'peso_procentaje' => $resultado_aprendizaje['peso_procentaje'],
                'orden' => $resultado_aprendizaje['orden'],
            ]);
        }
        $this->command->info('¡Tabla resultados_aprendizajes inicializada con datos!');
    }

    public static $resultados_aprendizaje = array(
    [
        'modulo_formativo_id' => 1,
        'codigo' => 'RA001',
        'descripcion' => 'Descripción del resultado de aprendizaje 1',
        'peso_procentaje' => 5,
        'orden' => 1,
    ],
    [
        'modulo_formativo_id' => 2,
        'codigo' => 'RA002',
        'descripcion' => 'Descripción del resultado de aprendizaje 2',
        'peso_procentaje' => 5,
        'orden' => 2,
    ],
    [
        'modulo_formativo_id' => 3,
        'codigo' => 'RA003',
        'descripcion' => 'Descripción del resultado de aprendizaje 3',
        'peso_procentaje' => 5,
        'orden' => 3,
    ],
    [
        'modulo_formativo_id' => 4,
        'codigo' => 'RA004',
        'descripcion' => 'Descripción del resultado de aprendizaje 4',
        'peso_procentaje' => 5,
        'orden' => 4,
    ],
    [
        'modulo_formativo_id' => 5,
        'codigo' => 'RA005',
        'descripcion' => 'Descripción del resultado de aprendizaje 5',
        'peso_procentaje' => 5,
        'orden' => 5,
    ],
    [
        'modulo_formativo_id' => 6,
        'codigo' => 'RA006',
        'descripcion' => 'Descripción del resultado de aprendizaje 6',
        'peso_procentaje' => 5,
        'orden' => 6,
    ],
    [
        'modulo_formativo_id' => 7,
        'codigo' => 'RA007',
        'descripcion' => 'Descripción del resultado de aprendizaje 7',
        'peso_procentaje' => 5,
        'orden' => 7,
    ],
    [
        'modulo_formativo_id' => 8,
        'codigo' => 'RA008',
        'descripcion' => 'Descripción del resultado de aprendizaje 8',
        'peso_procentaje' => 5,
        'orden' => 8,
    ],
    [
        'modulo_formativo_id' => 9,
        'codigo' => 'RA009',
        'descripcion' => 'Descripción del resultado de aprendizaje 9',
        'peso_procentaje' => 5,
        'orden' => 9,
    ],
    [
        'modulo_formativo_id' => 10,
        'codigo' => 'RA010',
        'descripcion' => 'Descripción del resultado de aprendizaje 10',
        'peso_procentaje' => 5,
        'orden' => 10,
    ],
    [
        'modulo_formativo_id' => 11,
        'codigo' => 'RA011',
        'descripcion' => 'Descripción del resultado de aprendizaje 11',
        'peso_procentaje' => 5,
        'orden' => 11,
    ],
    [
        'modulo_formativo_id' => 12,
        'codigo' => 'RA012',
        'descripcion' => 'Descripción del resultado de aprendizaje 12',
        'peso_procentaje' => 5,
        'orden' => 12,
    ],
    [
        'modulo_formativo_id' => 13,
        'codigo' => 'RA013',
        'descripcion' => 'Descripción del resultado de aprendizaje 13',
        'peso_procentaje' => 5,
        'orden' => 13,
    ],
    [
        'modulo_formativo_id' => 14,
        'codigo' => 'RA014',
        'descripcion' => 'Descripción del resultado de aprendizaje 14',
        'peso_procentaje' => 5,
        'orden' => 14,
    ],
    [
        'modulo_formativo_id' => 15,
        'codigo' => 'RA015',
        'descripcion' => 'Descripción del resultado de aprendizaje 15',
        'peso_procentaje' => 5,
        'orden' => 15,
    ],
    [
        'modulo_formativo_id' => 16,
        'codigo' => 'RA016',
        'descripcion' => 'Descripción del resultado de aprendizaje 16',
        'peso_procentaje' => 5,
        'orden' => 16,
    ],
    [
        'modulo_formativo_id' => 17,
        'codigo' => 'RA017',
        'descripcion' => 'Descripción del resultado de aprendizaje 17',
        'peso_procentaje' => 5,
        'orden' => 17,
    ],
    [
        'modulo_formativo_id' => 18,
        'codigo' => 'RA018',
        'descripcion' => 'Descripción del resultado de aprendizaje 18',
        'peso_procentaje' => 5,
        'orden' => 18,
    ],
    [
        'modulo_formativo_id' => 19,
        'codigo' => 'RA019',
        'descripcion' => 'Descripción del resultado de aprendizaje 19',
        'peso_procentaje' => 5,
        'orden' => 19,
    ],
    [
        'modulo_formativo_id' => 20,
        'codigo' => 'RA020',
        'descripcion' => 'Descripción del resultado de aprendizaje 20',
        'peso_procentaje' => 5,
        'orden' => 20,
    ],
);

}
