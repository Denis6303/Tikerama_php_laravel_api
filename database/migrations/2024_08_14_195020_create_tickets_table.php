<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Exécute les migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('ticket_id'); // Clé primaire auto-incrémentée
            $table->unsignedBigInteger('ticket_event_id');
            $table->unsignedBigInteger('ticket_order_id')->nullable(); // Peut être nul
            $table->string('ticket_email');
            $table->string('ticket_phone', 20);
            $table->mediumInteger('ticket_price');
            $table->string('ticket_key', 100);
            $table->unsignedBigInteger('ticket_ticket_type_id');
            $table->enum('ticket_status', ['active', 'validated', 'expired', 'cancelled']);
            $table->timestamp('ticket_created_on')->useCurrent(); // Date de création du ticket
            $table->timestamps(); // Pour created_at et updated_at

            // Clés étrangères
            $table->foreign('ticket_event_id')
                ->references('event_id')->on('events')
                ->onDelete('cascade');
            $table->foreign('ticket_order_id')
                ->references('order_id')->on('orders')
                ->onDelete('set null');
            $table->foreign('ticket_ticket_type_id')
                ->references('ticket_type_id')->on('ticket_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Annule les migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
}
