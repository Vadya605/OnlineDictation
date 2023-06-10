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
            $table->text('video_link')->nullable();
            $table->boolean('is_active')->nullable();
            $table->text('description')->nullable();
            $table->dateTime('from_date_time')->nullable();
            $table->dateTime('to_date_time')->nullable();
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
