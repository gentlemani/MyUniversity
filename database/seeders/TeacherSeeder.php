<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teacher = Teacher::create(['name' => 'Mike', 'gender' => 'Hombre', 'coordinator_id' => 1]);
        $teacher->user()->create(['email' => 'mike@docentes.udg.mx', 'password' => 'mike@docentes.udg.mx']);
        $teacher = Teacher::create(['name' => 'Andrew', 'gender' => 'Hombre', 'coordinator_id' => 1]);
        $teacher->user()->create(['email' => 'andrew@docentes.udg.mx', 'password' => 'andrew@docentes.udg.mx']);
    }
}
