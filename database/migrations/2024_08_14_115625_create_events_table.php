<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->enum('event_category', ['Autre','Concert-Spectacle','Diner Gala','Festival','Formation']);
            $table->string('event_title');
            $table->text('event_description');
            $table->dateTime('event_date');
            $table->string('event_image');
            $table->string('event_city');
            $table->string('event_address');
            $table->enum('event_status', ['upcoming', 'completed', 'cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
