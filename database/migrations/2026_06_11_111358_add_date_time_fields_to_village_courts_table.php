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
        Schema::table('village_courts', function (Blueprint $table) {
            $table->time('case_time')->nullable()->after('case_date');
            $table->date('hajir_date')->nullable()->after('case_time');
            $table->time('hajir_time')->nullable()->after('hajir_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('village_courts', function (Blueprint $table) {
            $table->dropColumn(['case_time', 'hajir_date', 'hajir_time']);
        });
    }
};
