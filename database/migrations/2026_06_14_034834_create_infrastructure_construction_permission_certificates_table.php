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
        if (!Schema::hasTable('infrastructure_construction_permission_certificates')) {
            Schema::create('infrastructure_construction_permission_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('system_id')->unique('icp_certs_system_id_unique');
            $table->foreignId('user_id')->constrained('users', 'id', 'icp_certs_user_id_foreign')->onDelete('cascade');
            $table->double('fees', 16, 2)->default(0.00);
            $table->integer('quantity')->default(1);
            $table->double('total_amount', 16, 2)->default(0.00);
            $table->bigInteger('created_by');
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infrastructure_construction_permission_certificates');
    }
};