<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Exécuter les seeds de la base de données.
     *
     * @return void
     */
    public function run(): void
    {
        // Crée 20 tickets pour les tests
        Ticket::factory()->count(50)->create();
    }
}
