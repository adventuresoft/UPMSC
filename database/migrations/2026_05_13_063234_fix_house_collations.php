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
        Schema::table('houses', function (Blueprint $table) {
            if (!Schema::hasColumn('houses', 'room_usage')) {
                $table->string('room_usage')->nullable();
            }
            if (!Schema::hasColumn('houses', 'block_section')) {
                $table->string('block_section')->nullable();
            }
            
            $table->string('room_usage')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable()->change();
            $table->string('block_section')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->string('room_usage')->charset('latin1')->collation('latin1_swedish_ci')->nullable()->change();
            $table->string('block_section')->charset('latin1')->collation('latin1_swedish_ci')->nullable()->change();
        });
    }
};
