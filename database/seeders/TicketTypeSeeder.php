<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TicketType;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketType::create([
            'ticket_type_event_id' => 1, // Assure-toi que l'ID de l'événement correspond
            'ticket_type_name' => 'VIP',
            'ticket_type_price' => 100,
            'ticket_type_quantity' => 50,
            'ticket_type_real_quantity' => 50,
            'ticket_type_total_quantity' => 100,
            'ticket_type_description' => 'Accès VIP avec avantages exclusifs.',
        ]);

        TicketType::create([
            'ticket_type_event_id' => 2, // Assure-toi que l'ID de l'événement correspond
            'ticket_type_name' => 'Standard',
            'ticket_type_price' => 30,
            'ticket_type_quantity' => 200,
            'ticket_type_real_quantity' => 200,
            'ticket_type_total_quantity' => 200,
            'ticket_type_description' => 'Accès standard au festival.',
        ]);
    }
}
