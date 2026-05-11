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
        Schema::table('nid_correction_certificates', function (Blueprint $table) {
            $table->string('applicant_name_en')->nullable();
            $table->string('applicant_husband_name')->nullable();
            $table->string('applicant_blood_group')->nullable();
            $table->text('applicant_address')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_nid')->nullable();
            $table->double('payment_amount', 16, 2)->default(0.00);
            $table->string('payment_receipt_no')->nullable();
            $table->text('attachments_list')->nullable();
            $table->json('correction_data')->nullable(); // To store the table content
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nid_correction_certificates', function (Blueprint $table) {
            $table->dropColumn([
                'applicant_name_en', 'applicant_husband_name', 'applicant_blood_group',
                'applicant_address', 'guardian_name', 'guardian_nid',
                'payment_amount', 'payment_receipt_no', 'attachments_list', 'correction_data'
            ]);
        });
    }
};
