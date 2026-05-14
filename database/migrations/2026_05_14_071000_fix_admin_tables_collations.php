<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix collations for administrative tables to support Bengali characters
        $tables = [
            'districts' => ['name', 'bn_name'],
            'thanas' => ['name', 'bn_name'],
            'unions' => ['name', 'bn_name'],
            'pourashavas' => ['name', 'bn_name'],
            'city_corporations' => ['name', 'bn_name'],
            'villages' => ['name', 'en_name', 'bn_name'],
        ];

        foreach ($tables as $table => $columns) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $tableGroup) use ($table, $columns) {
                    foreach ($columns as $column) {
                        if (Schema::hasColumn($table, $column)) {
                            DB::statement("ALTER TABLE `{$table}` MODIFY `{$column}` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL");
                        }
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse collation fix (back to default if needed, though usually utf8mb4 is better)
    }
};
