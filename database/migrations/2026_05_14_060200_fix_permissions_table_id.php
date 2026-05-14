<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Fix ID and ensure it is Auto Increment. 
        // We remove PRIMARY KEY here because it already exists, causing "Multiple primary key defined" error.
        DB::statement('ALTER TABLE permissions MODIFY id BIGINT UNSIGNED AUTO_INCREMENT');
        
        // Add unique index for name and guard_name if it doesn't exist
        Schema::table('permissions', function (Blueprint $table) {
            if (!Schema::hasIndex('permissions', 'permissions_name_guard_name_unique')) {
                $table->unique(['name', 'guard_name']);
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
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropUnique(['name', 'guard_name']);
        });
        
        DB::statement('ALTER TABLE permissions MODIFY id BIGINT UNSIGNED');
        DB::statement('ALTER TABLE permissions DROP PRIMARY KEY');
    }
};
