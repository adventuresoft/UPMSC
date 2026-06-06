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
            $table->double('cash_amount')->change();
            $table->double('house_price')->change();
            $table->double('flat_price')->change();
            $table->double('diamond_price')->change();
            $table->double('gold_price')->change();
            $table->double('silver_price')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_infos', function (Blueprint $table) {
            $table->double('cash_amount', 16, 2)->change();
            $table->double('house_price', 16, 2)->change();
            $table->double('flat_price', 16, 2)->change();
            $table->double('diamond_price', 16, 2)->change();
            $table->double('gold_price', 16, 2)->change();
            $table->double('silver_price', 16, 2)->change();
        });
    }
};
