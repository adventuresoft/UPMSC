<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('organization_transfers')) {
            Schema::create('organization_transfers', function (Blueprint $table) {
                $table->id();
                $table->foreignId('organization_id')->constrained('organizations')->onDelete('cascade');
                $table->foreignId('source_institute_id')->nullable()->constrained('institutes')->nullOnDelete();
                $table->foreignId('to_institute_id')->constrained('institutes')->cascadeOnDelete();
                $table->string('status')->default('pending');
                $table->foreignId('requested_by')->nullable()->constrained('users')->nullOnDelete();
                $table->foreignId('responded_by')->nullable()->constrained('users')->nullOnDelete();
                $table->text('remarks')->nullable();
                $table->text('response_comment')->nullable();
                $table->timestamp('requested_at')->nullable();
                $table->timestamp('responded_at')->nullable();
                $table->timestamps();

                $table->index(['organization_id', 'status']);
                $table->index(['to_institute_id', 'status']);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('organization_transfers');
    }
};
