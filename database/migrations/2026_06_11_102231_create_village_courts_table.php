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
        Schema::create('village_courts', function (Blueprint $table) {
            $table->id();
            $table->string('case_no')->unique()->nullable();
            $table->unsignedBigInteger('institute_id')->nullable();
            $table->unsignedBigInteger('badi_id')->nullable();
            $table->json('bibadi_ids')->nullable();
            $table->json('shakkhi_ids')->nullable();
            $table->text('ovijog_er_biboron')->nullable();
            $table->text('ghotona_sombolito')->nullable();
            $table->date('case_date')->nullable();
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            
            $table->foreign('badi_id')->references('id')->on('people')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('village_courts');
    }
};
