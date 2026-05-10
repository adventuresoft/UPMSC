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
            $table->string('login_id')->nullable()->unique()->after('approved_id');
            $table->string('password')->nullable()->after('login_id');
            $table->text('plain_password_hint')->nullable()->after('password');
            $table->timestamp('credentials_set_at')->nullable()->after('plain_password_hint');
            $table->string('credentials_set_by')->nullable()->after('credentials_set_at');
            $table->enum('login_status', ['active', 'suspended', 'pending'])
                  ->default('pending')->after('credentials_set_by');
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
            $table->dropColumn([
                'login_id',
                'password',
                'plain_password_hint',
                'credentials_set_at',
                'credentials_set_by',
                'login_status'
            ]);
        });
    }
};