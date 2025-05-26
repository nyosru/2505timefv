<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3, true),
            'event_date' => $this->faker->dateTimeBetween('-2 years', '+1 year')->format('Y-m-d'),
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'venue' => $this->faker->company(),
            'description' => $this->faker->paragraphs(2, true),
            'photo' => null, // Можно добавить логику для фото, если нужно

        ];
    }
}
