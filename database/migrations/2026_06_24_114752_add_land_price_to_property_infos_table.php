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
        Schema::table('property_infos', function (Blueprint $table) {
            $table->decimal('land_price', 15, 2)->nullable();
            $table->text('house_information')->nullable();
            $table->text('land_information')->nullable();
            $table->text('diamond_information')->nullable();
            $table->text('gold_information')->nullable();
            $table->text('silver_information')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_infos', function (Blueprint $table) {
            $table->dropColumn([
                'land_price',
                'house_information',
                'land_information',
                'diamond_information',
                'gold_information',
                'silver_information'
            ]);
        });
    }
};
