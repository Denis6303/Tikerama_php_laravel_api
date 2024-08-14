<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Event;
use App\Models\TicketType;
use App\Models\Order;

class TicketFactory extends Factory
{
    /**
     * Définit l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_event_id' => Event::factory(), // Utilise un EventFactory pour générer un événement associé
            'ticket_email' => $this->faker->unique()->safeEmail(),
            'ticket_phone' => $this->faker->phoneNumber(),
            'ticket_price' => $this->faker->numberBetween(10, 1000),
            'ticket_order_id' => Order::factory(), // Utilise un OrderFactory pour générer une commande associée
            'ticket_key' => Str::random(10), // Génère une clé unique pour le ticket
            'ticket_ticket_type_id' => TicketType::factory(), // Utilise un TicketTypeFactory pour générer un type de ticket associé
            'ticket_status' => $this->faker->randomElement(['active', 'validated', 'expired', 'cancelled']),
            'ticket_created_on' => $this->faker->dateTimeThisYear(), // Date de création aléatoire dans l'année en cours
        ];
    }
}
