<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            'Россия',
            'США',
            'Канада',
            'Германия',
            'Беларусь',
            'Таджикистан',
            'Армения',
            'Казахстан',
            'Франция',
            'Великобритания',
            'Япония',
            'Китай',
            'Бразилия',
            'Австралия',
        ];

        foreach ($countries as $name) {
            Country::create(['name' => $name]);
        }

    }
}
