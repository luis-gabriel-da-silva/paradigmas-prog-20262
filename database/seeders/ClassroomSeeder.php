<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        // Turmas fixas, úteis para testar no Postman
        Classroom::create(['name' => 'Turma A', 'vacancies' => 30]);
        Classroom::create(['name' => 'Turma B', 'vacancies' => 25]);
        Classroom::create(['name' => 'Turma Lotada', 'vacancies' => 1]);

        // Turmas aleatórias
        Classroom::factory()->count(5)->create();
    }
}