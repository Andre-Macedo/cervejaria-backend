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
            Schema::table('users', function (Blueprint $table) {
                $table->string('social_id')->nullable();
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
            DB::beginTransaction();

            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('social_id');
                $table->dropSoftDeletes();
            });

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();

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
