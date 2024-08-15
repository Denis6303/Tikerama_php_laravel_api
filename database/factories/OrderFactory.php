<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Définir l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => $this->faker->unique()->numerify('ORD-#####'), // Numéro de la commande
            'order_event_id' => \App\Models\Event::factory(), // Génère un événement pour associer à la commande
            'order_price' => $this->faker->numberBetween(100, 1000), // Prix total de la commande
            'order_type' => $this->faker->word(), // Type de la commande
            'order_payment' => $this->faker->word(), // Mode de paiement de la commande
            'order_info' => $this->faker->text(), // Informations supplémentaires sur la commande
            'order_created_on' => $this->faker->dateTime(), // Date de création de la commande
            'user_id' => User::factory(), // Associer un utilisateur existant via la fabrique User
        ];
    }
}
