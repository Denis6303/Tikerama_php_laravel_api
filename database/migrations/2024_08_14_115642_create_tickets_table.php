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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_event_id'); // Clé étrangère vers la table events
            $table->string('ticket_email');
            $table->string('ticket_phone');
            $table->integer('ticket_price');
            $table->unsignedBigInteger('ticket_order_id'); // Clé étrangère vers la table orders
            $table->string('ticket_key');
            $table->unsignedBigInteger('ticket_ticket_type_id'); // Clé étrangère vers la table ticket_types
            $table->enum('ticket_status', ['active', 'validated', 'expired', 'cancelled']);
            $table->timestamps();

            // Définir les clés étrangères
            $table->foreign('ticket_event_id')
                  ->references('id')
                  ->on('events')
                  ->onDelete('cascade');

            $table->foreign('ticket_order_id')
                  ->references('id')
                  ->on('orders')
                  ->onDelete('cascade');

            $table->foreign('ticket_ticket_type_id')
                  ->references('id')
                  ->on('ticket_types')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
