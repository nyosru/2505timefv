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

//        $faker = \Faker\Factory::create('ru_RU');
//        $this->faker = Factory::create('ru_RU');

        // Получаем случайный id мероприятия (или null)
        $eventIds = Event::pluck('id')->toArray();
        $eventId = $this->faker->optional()->randomElement($eventIds);

        // Получаем случайный id спортсмена (или null)
        $athleteIds = Athlete::pluck('id')->toArray();
        $athleteId = $this->faker->optional()->randomElement($athleteIds);

        $minitext = $this->faker->optional()->text(100);

        return [
            'title' => 'новость заголовок '.$this->faker->sentence(rand(3, 10), true),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'short_text' => ( !empty($minitext) ? 'короткий текст новости '.$minitext : null ),
            'full_text' => 'полный текст новости '.$this->faker->paragraphs(3, true) ,
            'event_id' => rand(1,5) == 5 ? $eventId : null,
            'athlete_id' => rand(1,5) == 5 ? $athleteId: null,
        ];
    }
}
