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
        Schema::table('family_infos', function (Blueprint $table) {
            $table->string('spouse_name_bn')->nullable()->after('spouse_name');
            $table->longText('children_details')->nullable()->after('girls');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('family_infos', function (Blueprint $table) {
            $table->dropColumn('spouse_name_bn');
            $table->dropColumn('children_details');
        });
    }
};
