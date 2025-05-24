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
        Schema::table('player_scores', function (Blueprint $table) {
            $table->foreignId('player_id')->constrained('players');
            $table->dropColumn('player_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('player_scores', function (Blueprint $table) {
            $table->string('player_name')->nullable();
            $table->dropForeign(['player_id']);
            $table->dropColumn('player_id');
        });
    }
};
