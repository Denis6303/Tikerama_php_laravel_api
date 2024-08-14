<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketType>
 */
class TicketTypeFactory extends Factory
{
    /**
     * Définir l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_type_event_id' => \App\Models\Event::factory(), // Génère un événement pour associer au type de ticket
            'ticket_type_name' => $this->faker->word(), // Nom du type de ticket
            'ticket_type_price' => $this->faker->numberBetween(10, 500), // Prix du type de ticket
            'ticket_type_quantity' => $this->faker->numberBetween(1, 100), // Quantité totale de tickets disponibles
            'ticket_type_real_quantity' => $this->faker->numberBetween(1, 100), // Quantité réelle de tickets disponibles
            'ticket_type_total_quantity' => $this->faker->numberBetween(1, 100), // Quantité totale de tickets
            'ticket_type_description' => $this->faker->text(), // Description du type de ticket
        ];
    }
}
