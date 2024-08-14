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
        Schema::create('orders_intents', function (Blueprint $table) {
            $table->id();
            $table->integer('order_intent_price');
            $table->string('order_intent_type');
            $table->string('user_email');
            $table->string('user_phone');
            $table->timestamp('expiration_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_intents');
    }
};
