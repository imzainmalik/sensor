<?php

namespace Database\Seeders;

use App\Models\SensorType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SensorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        SensorType::create([
           'name' => 'Energy',     
        ]);

        SensorType::create([
           'name' => 'Gas',     
        ]);

        SensorType::create([
           'name' => 'Water',     
        ]);
    }
}
