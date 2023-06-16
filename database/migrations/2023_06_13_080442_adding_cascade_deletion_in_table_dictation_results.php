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
        Schema::table('dictation_results', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['dictation_id']);

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('dictation_id')->references('id')->on('dictations')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dictation_results', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['dictation_id']);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('dictation_id')->references('id')->on('dictations');
        });
    }
};
