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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('wedding_id')->unsigned()->index();
            $table->foreign('wedding_id')->references('id')->on('weddings')->onDelete('cascade');
            $table->string('title');
            $table->dateTime('date');
            $table->string('address')->nullable();
            $table->string('gmaps_link')->nullable();
            $table->string('stream_url')->nullable();
            $table->integer('capacity');
            $table->integer('capacity_start');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
