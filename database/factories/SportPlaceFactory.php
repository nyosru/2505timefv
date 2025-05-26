<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\SportPlace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SportPlace>
 */
class SportPlaceFactory extends Factory
{
    protected $model = SportPlace::class;

    public function definition()
    {
        // Получаем случайный id города
        $cityIds = City::pluck('id')->toArray();

        return [
            'city_id' => $this->faker->randomElement($cityIds),
            'name' => $this->faker->company() . ' Спортивное место',
            'photo' => null, // Можно добавить логику для локального фото, если нужно
            'photo_s3_url' => null, // Можно добавить генерацию ссылки, если нужно
        ];
    }
}
