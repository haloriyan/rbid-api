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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('wedding_id')->unsigned()->index();
            $table->foreign('wedding_id')->references('id')->on('weddings')->onDelete('cascade');
            $table->bigInteger('guest_id')->unsigned()->index();
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
            $table->bigInteger('schedule_id')->unsigned()->index();
            $table->foreign('schedule_id')->references('id')->on('guests')->onDelete('cascade');
            $table->boolean('has_checked_in');
            $table->boolean('has_viewed_on_screen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
