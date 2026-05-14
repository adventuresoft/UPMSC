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
        // Fix ID and Primary Key
        DB::statement('ALTER TABLE permissions MODIFY id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY');
        
        // Add unique index for name and guard_name
        Schema::table('permissions', function (Blueprint $table) {
            $table->unique(['name', 'guard_name']);
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
