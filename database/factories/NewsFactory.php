<?php

namespace Database\Factories;

use App\Models\Athlete;
use App\Models\Event;
use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{

    protected $model = News::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Получаем случайный id мероприятия (или null)
        $eventIds = Event::pluck('id')->toArray();
        $eventId = $this->faker->optional()->randomElement($eventIds);

        // Получаем случайный id спортсмена (или null)
        $athleteIds = Athlete::pluck('id')->toArray();
        $athleteId = $this->faker->optional()->randomElement($athleteIds);

        return [
            'title' => $this->faker->sentence(6, true),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'short_text' => $this->faker->optional()->text(100),
            'full_text' => $this->faker->paragraphs(3, true),
            'event_id' => $eventId,
            'athlete_id' => $athleteId,
        ];
    }
}
