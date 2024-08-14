<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id'); // Clé primaire auto-incrémentée
            $table->unsignedBigInteger('order_event_id');
            $table->string('order_number'); // Numéro de la commande
            $table->mediumInteger('order_price'); // Prix total de la commande
            $table->string('order_type'); // Type de la commande
            $table->string('order_payment'); // Mode de paiement
            $table->text('order_info')->nullable(); // Informations supplémentaires
            $table->timestamp('order_created_on')->useCurrent(); // Ajout du champ order_created_on
            $table->timestamps(); // Les colonnes `created_at` et `updated_at`
            
            // Clé étrangère
            $table->foreign('order_event_id')
                ->references('event_id')->on('events')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
