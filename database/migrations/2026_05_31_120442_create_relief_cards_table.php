<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('relief_cards')) {
            Schema::create('relief_cards', function (Blueprint $table) {
                $table->id();
                $table->string('system_id')->unique();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->string('relief_type'); // e.g. VGD (ভিজিডি), VGF (ভিজিএফ), OMS (ওএমএস), Old Age Allowance (বয়স্ক ভাতা), Disability Allowance (প্রতিবন্ধী ভাতা)
                $table->double('monthly_income', 16, 2)->default(0.00);
                $table->integer('family_members')->default(1);
                $table->text('reason')->nullable();
                $table->tinyInteger('status')->default(0)->comment('0=Pending, 1=Approved, 2=Rejected');
                $table->bigInteger('created_by');
                $table->bigInteger('approved_by')->nullable();
                $table->timestamp('approved_at')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relief_cards');
    }
};
