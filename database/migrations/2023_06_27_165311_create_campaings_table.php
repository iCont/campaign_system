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
        Schema::create('campaings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('holiday_id');
            $table->boolean('radio_spot');
            $table->boolean('slide_web');
            $table->boolean('social_networks_posts');
            $table->boolean('social_networks_front_page');
            $table->boolean('sales');
            $table->dateTime('date_of_first_review');
            $table->dateTime('delivery_final_date');
            $table->dateTime('start_date_campaing');
            $table->dateTime('end_date_campaing');
            $table->text('actions_to_do');
            $table->text('notes');
            $table->unsignedBigInteger('user_id');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaings');
    }
};
