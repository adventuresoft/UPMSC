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
        Schema::table('married_certificates', function (Blueprint $table) {
            if (!Schema::hasColumn('married_certificates', 'spouse_name')) {
                $table->string('spouse_name')->nullable()->after('wife_system_id');
            }

            if (!Schema::hasColumn('married_certificates', 'spouse_nid')) {
                $table->string('spouse_nid')->nullable()->after('spouse_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('married_certificates', function (Blueprint $table) {
            if (Schema::hasColumn('married_certificates', 'spouse_nid')) {
                $table->dropColumn('spouse_nid');
            }

            if (Schema::hasColumn('married_certificates', 'spouse_name')) {
                $table->dropColumn('spouse_name');
            }
        });
    }
};

