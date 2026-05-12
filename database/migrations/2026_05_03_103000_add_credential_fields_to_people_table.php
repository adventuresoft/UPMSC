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
        Schema::table('people', function (Blueprint $table) {
            if (!Schema::hasColumn('people', 'login_id')) {
                $table->string('login_id')->nullable()->unique();
            }
            if (!Schema::hasColumn('people', 'password')) {
                $table->string('password')->nullable()->after('login_id');
            }
            if (!Schema::hasColumn('people', 'plain_password_hint')) {
                $table->text('plain_password_hint')->nullable()->after('password');
            }
            if (!Schema::hasColumn('people', 'credentials_set_at')) {
                $table->timestamp('credentials_set_at')->nullable()->after('plain_password_hint');
            }
            if (!Schema::hasColumn('people', 'credentials_set_by')) {
                $table->string('credentials_set_by')->nullable()->after('credentials_set_at');
            }
            if (!Schema::hasColumn('people', 'login_status')) {
                $table->enum('login_status', ['active', 'suspended', 'pending'])
                      ->default('pending')->after('credentials_set_by');
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
        Schema::table('people', function (Blueprint $table) {
            $columnsToDrop = [];
            
            $checkColumns = [
                'login_id',
                'password',
                'plain_password_hint',
                'credentials_set_at',
                'credentials_set_by',
                'login_status'
            ];

            foreach ($checkColumns as $column) {
                if (Schema::hasColumn('people', $column)) {
                    $columnsToDrop[] = $column;
                }
            }

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};