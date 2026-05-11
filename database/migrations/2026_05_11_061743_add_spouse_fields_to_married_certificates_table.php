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
            if (!Schema::hasColumn('married_certificates', 'husband_id')) {
                $table->unsignedBigInteger('husband_id')->nullable()->after('user_id');
                $table->foreign('husband_id')->references('id')->on('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('married_certificates', 'husband_system_id')) {
                $table->string('husband_system_id')->nullable()->after('husband_id');
            }
            if (!Schema::hasColumn('married_certificates', 'wife_id')) {
                $table->unsignedBigInteger('wife_id')->nullable()->after('husband_system_id');
                $table->foreign('wife_id')->references('id')->on('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('married_certificates', 'wife_system_id')) {
                $table->string('wife_system_id')->nullable()->after('wife_id');
            }
            if (!Schema::hasColumn('married_certificates', 'marriage_date')) {
                $table->date('marriage_date')->nullable()->after('wife_system_id');
            }
            if (!Schema::hasColumn('married_certificates', 'marriage_place')) {
                $table->string('marriage_place')->nullable()->after('marriage_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('married_certificates', function (Blueprint $table) {
            if (Schema::hasColumn('married_certificates', 'husband_id')) {
                $table->dropForeign(['husband_id']);
                $table->dropColumn('husband_id');
            }
            if (Schema::hasColumn('married_certificates', 'husband_system_id')) {
                $table->dropColumn('husband_system_id');
            }
            if (Schema::hasColumn('married_certificates', 'wife_id')) {
                $table->dropForeign(['wife_id']);
                $table->dropColumn('wife_id');
            }
            if (Schema::hasColumn('married_certificates', 'wife_system_id')) {
                $table->dropColumn('wife_system_id');
            }
            if (Schema::hasColumn('married_certificates', 'marriage_date')) {
                $table->dropColumn('marriage_date');
            }
            if (Schema::hasColumn('married_certificates', 'marriage_place')) {
                $table->dropColumn('marriage_place');
            }
        });
    }
};
