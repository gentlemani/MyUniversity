<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create(['name' => 'Algoritmia', 'section' => 'D02', 'schedule' => 'Lunes y miércoles de 11:00-12:55', 'coordinator_id' => 1, 'clave' => 'I5890']);
        Subject::create(['name' => 'Seguridad', 'section' => 'D04', 'schedule' => 'Lunes y miércoles de 09:00-10:55', 'coordinator_id' => 1, 'clave' => 'I5235']);
        Subject::create(['name' => 'Programación', 'section' => 'D07', 'schedule' => 'Martes y jueves de 13:00-14:55', 'coordinator_id' => 1, 'clave' => 'I6797']);
        Subject::create(['name' => 'Matemáticas', 'section' => 'D08', 'schedule' => 'Viernes de 12:00-15:55', 'coordinator_id' => 1, 'clave' => 'I5932']);
    }
}
