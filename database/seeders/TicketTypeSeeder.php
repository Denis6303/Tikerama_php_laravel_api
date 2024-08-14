<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TicketType;

class TicketTypeSeeder extends Seeder
{
    /**
     * Exécuter les seeds de la base de données.
     *
     * @return void
     */
    public function run(): void
    {
        // Crée 10 types de tickets pour les tests
        TicketType::factory()->count(5)->create();
    }
}
