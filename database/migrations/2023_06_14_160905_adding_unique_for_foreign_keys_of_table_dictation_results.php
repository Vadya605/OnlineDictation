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
            $table->unique(['user_id', 'dictation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dictation_results', function (Blueprint $table) {
            $table->dropUnique('dictation_results_user_id_dictation_id_unique');
        });
    }
};
