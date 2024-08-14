<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Exécute les migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id'); // Clé primaire auto-incrémentée
            $table->enum('event_category', ['Autre', 'Concert-Spectacle', 'Diner Gala', 'Festival', 'Formation']);
            $table->string('event_title', 100);
            $table->mediumText('event_description');
            $table->dateTime('event_date');
            $table->string('event_image', 200);
            $table->string('event_city', 100);
            $table->string('event_address', 200);
            $table->enum('event_status', ['upcoming', 'completed', 'cancelled']);
            $table->timestamp('event_created_on')->useCurrent(); // Date de création de l'événement
            $table->timestamps(); // Pour created_at et updated_at
        });
    }

    /**
     * Annule les migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
}
