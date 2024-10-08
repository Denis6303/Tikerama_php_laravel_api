<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderIntentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('order_intents', function (Blueprint $table) {
            $table->id('order_intent_id'); // Identifiant unique de l’intention de commande
            $table->mediumInteger('order_intent_price'); // Prix total de l’intention de commande
            $table->string('order_intent_type', 50); // Type de l’intention de commande
            $table->string('user_email', 100); // Email de l’utilisateur
            $table->string('user_phone', 20); // Téléphone de l’utilisateur
            $table->dateTime('expiration_date'); // Date d’expiration de l’intention de commande
            $table->unsignedBigInteger('user_id'); // Clé étrangère vers la table users
            $table->timestamps(); // Les colonnes `created_at` et `updated_at`

            // Définir la contrainte de clé étrangère
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('order_intents', function (Blueprint $table) {
            // Supprimer la contrainte de clé étrangère avant de supprimer la colonne
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('order_intents');
    }
}
