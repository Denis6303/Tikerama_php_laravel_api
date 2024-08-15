<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('api_access_requests', function (Blueprint $table) {
            $table->string('api_key')->unique()->nullable();
            $table->string('api_secret')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('api_access_requests', function (Blueprint $table) {
            $table->dropColumn(['api_key', 'api_secret']);
        });
    }
};
