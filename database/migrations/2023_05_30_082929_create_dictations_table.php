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
        Schema::create('dictations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('video_link');
            $table->boolean('is_active');
            $table->text('description');
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dictations');
    }
};
