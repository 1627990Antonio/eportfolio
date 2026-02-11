<?php

namespace Database\Factories;

use App\Models\CicloFormativo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ModuloFormativo>
 */
class ModuloFormativoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ciclo_formativo_id' => CicloFormativo::factory(),
            'nombre' => $this->faker->sentence(3),
            'codigo' => $this->faker->unique()->bothify('MF-###'),
            'horas_totales' => $this->faker->numberBetween(100, 300),
            'curso_escolar' => $this->faker->year(),
            'centro' => $this->faker->word(),
            'docente_id' => User::factory(),
            'descripcion' => $this->faker->paragraph(),
        ];
    }
}
