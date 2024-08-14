<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderIntent;

class OrderIntentSeeder extends Seeder
{
    /**
     * Exécuter les seeds de la base de données.
     *
     * @return void
     */
    public function run(): void
    {
        // Crée 10 intentions de commande pour les tests
        OrderIntent::factory()->count(400)->create();
    }
}
