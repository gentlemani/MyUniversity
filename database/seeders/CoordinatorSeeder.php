<?php

namespace Database\Seeders;

use App\Models\Coordinator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coordinator = Coordinator::create(['name' => 'Sara Edith', 'degree' => 'INNI', 'gender' => 'Femenino']);
        $coordinator->user()->create(['email' => 'SaraEdith@coordinadores.udg.mx', 'password' => 'SaraEdith@coordinadores.udg.mx']);
    }
}
