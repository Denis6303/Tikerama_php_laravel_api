<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = \App\Models\Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_category' => $this->faker->randomElement(['Autre', 'Concert-Spectacle', 'Diner Gala', 'Festival', 'Formation']),
            'event_title' => $this->faker->sentence(5),
            'event_description' => $this->faker->paragraph(),
            'event_date' => $this->faker->dateTimeBetween('+1 week', '+1 year'),
            'event_image' => $this->faker->imageUrl(640, 480),
            'event_city' => $this->faker->city(),
            'event_address' => $this->faker->address(),
            'event_status' => $this->faker->randomElement(['upcoming', 'completed', 'cancelled']),
            'event_created_on' => $this->faker->dateTimeThisYear(), // Date de création aléatoire dans l'année en cours
        ];
    }
}
