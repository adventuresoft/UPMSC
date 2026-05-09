<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            if (!Schema::hasColumn('organizations', 'application_id')) {
                $table->string('application_id', 30)->nullable()->after('system_id');
            }
            if (!Schema::hasColumn('organizations', 'created_by')) {
                $table->bigInteger('created_by')->nullable()->after('status');
            }
            if (!Schema::hasColumn('organizations', 'updated_by')) {
                $table->bigInteger('updated_by')->nullable()->after('created_by');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn(['application_id', 'created_by', 'updated_by']);
        });
    }
};
