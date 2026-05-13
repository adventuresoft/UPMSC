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
        Schema::table('house_ownerships', function (Blueprint $table) {
            $table->string('is_union')->default('no')->after('house_id');
            $table->string('owner_id')->nullable()->after('is_union');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('house_ownerships', function (Blueprint $table) {
            $table->dropColumn(['is_union', 'owner_id']);
        });
    }
};
