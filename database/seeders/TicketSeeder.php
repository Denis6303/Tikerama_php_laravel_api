<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::create([
            'ticket_event_id' => 1,
            'ticket_email' => 'user1@example.com',
            'ticket_phone' => '1234567890',
            'ticket_price' => 100,
            'ticket_order_id' => 1,
            'ticket_key' => 'TICKET123456',
            'ticket_ticket_type_id' => 1,
            'ticket_status' => 'active',
        ]);

        Ticket::create([
            'ticket_event_id' => 2,
            'ticket_email' => 'user2@example.com',
            'ticket_phone' => '0987654321',
            'ticket_price' => 30,
            'ticket_order_id' => 2,
            'ticket_key' => 'TICKET654321',
            'ticket_ticket_type_id' => 2,
            'ticket_status' => 'active',
        ]);

    }
}
