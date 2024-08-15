<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Exécuter les seeds de la base de données.
     *
     * @return void
     */
    public function run(): void
    {
        // Crée 5 commandes pour les tests
        Order::factory()->count(20)->create();
    }
}
