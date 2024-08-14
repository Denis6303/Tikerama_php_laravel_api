<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'order_number' => 'ORD12345',
            'order_event_id' => 1,
            'order_price' => 100,
            'order_type' => 'online',
            'order_payment' => 'credit_card',
            'order_info' => 'Commande effectuée en ligne avec paiement par carte.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Order::create([
            'order_number' => 'ORD67890',
            'order_event_id' => 2,
            'order_price' => 60,
            'order_type' => 'in_person',
            'order_payment' => 'cash',
            'order_info' => 'Commande effectuée sur place avec paiement en espèces.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
