<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FamiliaProfesional>
 */
class FamiliaProfesionalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=>$this->faker->word(),
            'codigo'=>$this->faker->unique()->word(),
            'descripcion'=>$this->faker->sentence(),
        ];
    }
}
