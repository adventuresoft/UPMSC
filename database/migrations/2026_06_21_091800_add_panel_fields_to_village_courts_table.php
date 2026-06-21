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
            $table->unsignedBigInteger('panel_head_id')->nullable()->after('shakkhi_ids');
            $table->unsignedBigInteger('badi_up_member_id')->nullable()->after('panel_head_id');
            $table->unsignedBigInteger('badi_citizen_id')->nullable()->after('badi_up_member_id');
            $table->unsignedBigInteger('bibadi_up_member_id')->nullable()->after('badi_citizen_id');
            $table->unsignedBigInteger('bibadi_citizen_id')->nullable()->after('bibadi_up_member_id');
            $table->date('sunani_date')->nullable()->after('bibadi_citizen_id');
            $table->time('sunani_time')->nullable()->after('sunani_date');
            $table->text('verdict')->nullable()->after('sunani_time');
            $table->date('verdict_date')->nullable()->after('verdict');

            $table->foreign('panel_head_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('badi_up_member_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('badi_citizen_id')->references('id')->on('people')->onDelete('set null');
            $table->foreign('bibadi_up_member_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('bibadi_citizen_id')->references('id')->on('people')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('village_courts', function (Blueprint $table) {
            $table->dropForeign(['panel_head_id']);
            $table->dropForeign(['badi_up_member_id']);
            $table->dropForeign(['badi_citizen_id']);
            $table->dropForeign(['bibadi_up_member_id']);
            $table->dropForeign(['bibadi_citizen_id']);

            $table->dropColumn([
                'panel_head_id',
                'badi_up_member_id',
                'badi_citizen_id',
                'bibadi_up_member_id',
                'bibadi_citizen_id',
                'sunani_date',
                'sunani_time',
                'verdict',
                'verdict_date',
            ]);
        });
    }
};
