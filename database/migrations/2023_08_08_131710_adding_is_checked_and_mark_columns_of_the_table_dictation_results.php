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
            $table->boolean('is_checked')->default(false)->nullable();
            $table->integer('mark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dictation_results', function (Blueprint $table) {
            $table->dropColumn('is_checked');
            $table->dropColumn('mark');
        });
    }
};
