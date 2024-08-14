<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'event_category' => 'Concert-Spectacle',
            'event_title' => 'Concert de Rock',
            'event_description' => 'Un concert incroyable avec des groupes célèbres.',
            'event_date' => now()->addDays(30),
            'event_image' => 'concert_rock.jpg',
            'event_city' => 'Paris',
            'event_address' => '123 Rue de la Musique',
            'event_status' => 'upcoming',
        ]);

        Event::create([
            'event_category' => 'Festival',
            'event_title' => 'Festival de Jazz',
            'event_description' => 'Un festival de jazz avec des artistes internationaux.',
            'event_date' => now()->addDays(60),
            'event_image' => 'festival_jazz.jpg',
            'event_city' => 'Lyon',
            'event_address' => '456 Avenue des Arts',
            'event_status' => 'upcoming',
        ]);
    }
}
