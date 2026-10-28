<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Turma ' . fake()->unique()->bothify('?#'),
            'vacancies' => fake()->numberBetween(10, 40),
        ];
    }
}