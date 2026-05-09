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
        $tables = [
            'citizen_certificates',
            'character_certificates',
            'unmarried_certificates',
            'yearly_income_certificates',
            'residential_certificates'
        ];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) {
                    if (!Schema::hasColumn($table->getTable(), 'status')) {
                        $table->boolean('status')->default(1)->comment('0=>Pending, 1=>Approved');
                    }
                    if (!Schema::hasColumn($table->getTable(), 'purpose')) {
                        $table->string('purpose')->nullable();
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = [
            'citizen_certificates',
            'character_certificates',
            'unmarried_certificates',
            'yearly_income_certificates',
            'residential_certificates'
        ];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn(['status', 'purpose']);
                });
            }
        }
    }
};
