<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderIntent;

class OrderIntentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderIntent::create([
            'order_intent_price' => 100,
            'order_intent_type' => 'reservation',
            'user_email' => 'user1@example.com',
            'user_phone' => '1234567890',
            'expiration_date' => now()->addHours(2),
        ]);

        OrderIntent::create([
            'order_intent_price' => 60,
            'order_intent_type' => 'reservation',
            'user_email' => 'user2@example.com',
            'user_phone' => '0987654321',
            'expiration_date' => now()->addHours(2),
        ]);
    }
}
