<?php

namespace Database\Factories;

use App\Models\SportType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SportType>
 */
class SportTypeFactory extends Factory
{

    protected $model = SportType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        static $counter = 1;

        return [
            'name' => 'ВидСпортаТест: ' . $this->faker->word . ' ' . $counter++,
        ];
    }
}
