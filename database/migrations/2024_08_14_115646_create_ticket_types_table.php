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
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_type_event_id'); // Clé étrangère vers la table events
            $table->string('ticket_type_name');
            $table->integer('ticket_type_price');
            $table->integer('ticket_type_quantity');
            $table->integer('ticket_type_real_quantity');
            $table->integer('ticket_type_total_quantity');
            $table->text('ticket_type_description');
            $table->timestamps();

            // Définir la clé étrangère
            $table->foreign('ticket_type_event_id')
                  ->references('id')
                  ->on('events')
                  ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_types');
    }
};
