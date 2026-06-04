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
        Schema::create('guardian_acceptance_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('system_id')->nullable();
            $table->unsignedBigInteger('user_id'); // Applicant
            $table->unsignedBigInteger('guardian_id'); // Guardian
            $table->string('guardian_relation');
            $table->decimal('fees', 8, 2)->default(0);
            $table->integer('quantity')->default(1);
            $table->decimal('total_amount', 8, 2)->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardian_acceptance_certificates');
    }
};
