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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->integer('institute_id')->nullable()->after('registration_id');
            $table->integer('union_id')->nullable()->after('institute_id');
            $table->integer('thana_id')->nullable()->after('union_id');
            $table->integer('district_id')->nullable()->after('thana_id');
            $table->integer('created_by')->nullable()->after('paid_at');
            $table->integer('updated_by')->nullable()->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['institute_id', 'union_id', 'thana_id', 'district_id', 'created_by', 'updated_by']);
        });
    }
};
