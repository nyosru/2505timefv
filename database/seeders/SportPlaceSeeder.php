<?php

namespace Database\Seeders;

use App\Models\SportPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SportPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SportPlace::factory()->count(50)->create();
    }
}
