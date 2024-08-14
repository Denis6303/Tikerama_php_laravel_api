<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderIntent>
 */
class OrderIntentFactory extends Factory
{
    /**
     * Définir l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_intent_price' => $this->faker->numberBetween(100, 1000), // Prix total de l’intention de commande
            'order_intent_type' => $this->faker->word(), // Type de l’intention de commande
            'user_email' => $this->faker->unique()->safeEmail(), // Email de l’utilisateur
            'user_phone' => $this->faker->phoneNumber(), // Téléphone de l’utilisateur
            'expiration_date' => $this->faker->dateTimeBetween('now', '+1 week'), // Date d’expiration de l’intention de commande
        ];
    }
}
