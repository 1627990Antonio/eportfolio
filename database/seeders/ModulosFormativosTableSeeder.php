<?php

namespace Database\Seeders;

use App\Models\ModuloFormativo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulosFormativosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('modulos_formativos')->truncate();

        ModuloFormativo::factory(10)->create();
        
        $ciclos = CiclosFormativosTableSeeder::$ciclos;
        $codigosCiclos = array_column($ciclos, 'codCiclo');

        foreach (self::$modulos as $modulo) {
            $cicloId = array_search($modulo['codCiclo'], $codigosCiclos) + 1;

            DB::table('modulos_formativos')->insert([
                'ciclo_formativo_id' => $cicloId,
                'nombre'         => $modulo['nombre'],
                'codigo'         => $modulo['codigo'],
                'horas_totales'  => $modulo['horas_totales'],
                'curso_escolar'  => $modulo['curso_escolar'],
                'centro'         => $modulo['centro'],
                'docente_id'     => $modulo['docente_id'],
                'descripcion'    => $modulo['descripcion']
            ]);
        }

        $this->command->info('¡Tabla de MÓDULOS FORMATIVOS inicializada con datos!');
    }

    /**
     * Datos de ejemplo para los módulos formativos
     */
    private static $modulos = [
        [
            'codCiclo' => 'DAPW3',
            'nombre' => 'Desarrollo Web en Entorno Cliente',
            'codigo' => '0612',
            'horas_totales' => 160,
            'curso_escolar' => '2025/2026',
            'centro' => 'IES Tecnológico',
            'docente_id' => 1,
            'descripcion' => 'Programación basada en JavaScript y frameworks modernos.'
        ],
        [
            'codCiclo' => 'DAPW3',
            'nombre' => 'Desarrollo Web en Entorno Servidor',
            'codigo' => '0613',
            'horas_totales' => 180,
            'curso_escolar' => '2025/2026',
            'centro' => 'IES Tecnológico',
            'docente_id' => 1,
            'descripcion' => 'Desarrollo backend con PHP y bases de datos.'
        ],
        [
            'codCiclo' => 'ASIR3',
            'nombre' => 'Seguridad y Alta Disponibilidad',
            'codigo' => '0378',
            'horas_totales' => 100,
            'curso_escolar' => '2025/2026',
            'centro' => 'IES Informática',
            'docente_id' => 2,
            'descripcion' => 'Configuración de cortafuegos y balanceo de carga.'
        ],
        [
            'codCiclo' => 'SMIR2',
            'nombre' => 'Sistemas Operativos en Red',
            'codigo' => '0223',
            'horas_totales' => 140,
            'curso_escolar' => '2025/2026',
            'centro' => 'IES Digital',
            'docente_id' => 3,
            'descripcion' => 'Administración de Windows Server y Linux.'
        ],
    ];
}
