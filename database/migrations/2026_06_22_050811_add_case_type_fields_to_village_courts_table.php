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
            $table->string('case_category')->nullable()->after('shakkhi_ids');
            $table->text('case_type_details')->nullable()->after('case_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('village_courts', function (Blueprint $table) {
            $table->dropColumn(['case_category', 'case_type_details']);
        });
    }
};
