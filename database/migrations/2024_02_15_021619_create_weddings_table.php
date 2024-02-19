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
        Schema::create('weddings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('slug');
            $table->string('title');
            $table->text('intro')->nullable();

            $table->string('groom_name');
            $table->string('groom_photo');
            $table->string('groom_father')->nullable();
            $table->string('groom_mother')->nullable();

            $table->string('bride_name');
            $table->string('bride_photo');
            $table->string('bride_father')->nullable();
            $table->string('bride_mother')->nullable();

            $table->string('stream_url')->nullable();
            $table->string('background_music')->nullable();
            $table->string('template'); // default
            $table->string('timezone');
            $table->string('status'); // PENDING, ACTIVE
            $table->text('whatsapp_invitation_body')->nullable();
            $table->string('fees_paid_by'); // GUEST, ME
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weddings');
    }
};
