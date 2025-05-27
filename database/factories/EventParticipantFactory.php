<?php

namespace Database\Factories;

use App\Models\Athlete;
use App\Models\Event;
use App\Models\EventParticipant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventParticipant>
 */
class EventParticipantFactory extends Factory
{
    protected $model = EventParticipant::class;

    public function definition()
    {
        $athleteIds = Athlete::pluck('id')->toArray();
        $eventIds = Event::pluck('id')->toArray();

        return [
            'athlete_id' => $this->faker->randomElement($athleteIds),
            'event_id' => $this->faker->randomElement($eventIds),
            'place' => ( rand(1,5) == 1 ? $this->faker->numberBetween(1, 3) : null ), // место от 0 до 100
        ];
    }
}
