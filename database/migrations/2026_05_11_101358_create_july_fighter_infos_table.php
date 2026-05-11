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
        if (!Schema::hasTable('july_fighter_infos')) {
            Schema::create('july_fighter_infos', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->boolean('is_july_fighter')->default(false);
                $table->string('fighter_type')->nullable();
                $table->string('incident_location')->nullable();
                $table->string('injury_details')->nullable();
                $table->text('contribution_description')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('july_fighter_infos');
    }
};
