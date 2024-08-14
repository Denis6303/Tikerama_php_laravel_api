<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id('ticket_type_id'); // Identifiant unique du type de ticket
            $table->unsignedBigInteger('ticket_type_event_id'); // Colonne pour la clé étrangère
            $table->string('ticket_type_name', 50); // Nom du type de ticket
            $table->mediumInteger('ticket_type_price'); // Prix du type de ticket
            $table->integer('ticket_type_quantity'); // Quantité totale de tickets
            $table->integer('ticket_type_real_quantity'); // Quantité réelle de tickets
            $table->integer('ticket_type_total_quantity'); // Quantité totale de tickets
            $table->mediumText('ticket_type_description'); // Description du type de ticket
            $table->timestamps(); // Les colonnes `created_at` et `updated_at`
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_types');
    }
}
