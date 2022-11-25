<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = Student::create(['name' => 'Alex', 'semester' => 2, 'degree' => 'INNI', 'coordinator_id' => 1]);
        $student->user()->create(['email' => 'alex@alumnos.udg.mx', 'password' => 'alex@alumnos.udg.mx']);
        $student = Student::create(['name' => 'Juan', 'semester' => 3, 'degree' => 'INNI', 'coordinator_id' => 1]);
        $student->user()->create(['email' => 'juan@alumnos.udg.mx', 'password' => 'juan@alumnos.udg.mx']);
        $student = Student::create(['name' => 'Pedrin', 'semester' => 2, 'degree' => 'INNI', 'coordinator_id' => 1]);
        $student->user()->create(['email' => 'pedrin@alumnos.udg.mx', 'password' => 'pedrin@alumnos.udg.mx']);
    }
}
