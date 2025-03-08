<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {

            Schema::create('beers', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('type');
                $table->float('abv');
                $table->integer('ibu');
                $table->integer('bitterness')->nullable();
                $table->integer('malt')->nullable();
                $table->integer('body')->nullable();
                $table->string('temps')->nullable();
                $table->text('food_pairing')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });

        } catch (\Exception $e) {

            Log::error('Migration error: ' . $e->getMessage(),
            [
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString(),
                'exception' => $e
                ]);
            throw $e;
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        try {
            Schema::dropIfExists('beers');

        } catch (\Exception $e) {

            Log::error('Migration error: ' . $e->getMessage(),
            [
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString(),
                'exception' => $e
                ]);
            throw $e;
        }

    }
};
