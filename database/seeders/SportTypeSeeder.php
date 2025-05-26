<?php

namespace Database\Seeders;

use App\Models\SportType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SportType::factory()->count(20)->create();
    }
}
