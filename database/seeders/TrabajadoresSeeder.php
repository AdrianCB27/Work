<?php

namespace Database\Seeders;

use App\Models\Trabajador;
use Illuminate\Database\Seeder;
use Database\Factories\TrabajadorFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TrabajadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trabajador::Factory()->count(10)->create();
    }
}
