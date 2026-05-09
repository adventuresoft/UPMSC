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
            // Recipient Info
            $table->string('recipient_upazila_thana')->nullable();
            $table->string('recipient_upazila_thana_name')->nullable();
            $table->string('recipient_district')->nullable();

            // Applicant Info
            $table->string('applicant_name')->nullable();
            $table->string('applicant_nid')->nullable();
            $table->date('applicant_dob')->nullable();

            // Current Voter Registration Info
            $table->string('current_voter_no')->nullable();
            $table->string('current_voter_area_name')->nullable();
            $table->string('current_voter_area_no')->nullable();
            $table->string('current_upazila_thana')->nullable();
            $table->string('current_district')->nullable();
            $table->string('current_village_road')->nullable();
            $table->string('current_house_holding')->nullable();

            // Transfer Destination Info
            $table->string('transfer_district')->nullable();
            $table->string('transfer_upazila_thana')->nullable();
            $table->string('transfer_entity_type')->nullable(); // সিটি কর্পোরেশন/পৌরসভা/ইউনিয়ন/ক্যান্টনমেন্ট বোর্ড
            $table->string('transfer_entity_name')->nullable();
            $table->string('transfer_ward_no')->nullable();
            $table->string('transfer_voter_area_name')->nullable();
            $table->string('transfer_voter_area_no')->nullable();
            $table->string('transfer_village_road')->nullable();
            $table->string('transfer_house_holding')->nullable();
            $table->string('transfer_phone_mobile')->nullable();
            $table->string('transfer_post_office')->nullable();
            $table->string('transfer_post_code')->nullable();

            // Additional Info
            $table->string('staying_since')->nullable();
            $table->text('transfer_reason')->nullable();

            // Identifier Info (Witness)
            $table->string('identifier_name')->nullable();
            $table->string('identifier_nid')->nullable();
            $table->text('identifier_address')->nullable();
            
            // New fields from session requirements
            $table->integer('status')->default(1)->comment('0=>Pending, 1=>Approved');
            $table->string('purpose')->nullable();
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
                'recipient_upazila_thana', 'recipient_upazila_thana_name', 'recipient_district',
                'applicant_name', 'applicant_nid', 'applicant_dob',
                'current_voter_no', 'current_voter_area_name', 'current_voter_area_no', 'current_upazila_thana', 'current_district', 'current_village_road', 'current_house_holding',
                'transfer_district', 'transfer_upazila_thana', 'transfer_entity_type', 'transfer_entity_name', 'transfer_ward_no', 'transfer_voter_area_name', 'transfer_voter_area_no', 'transfer_village_road', 'transfer_house_holding', 'transfer_phone_mobile', 'transfer_post_office', 'transfer_post_code',
                'staying_since', 'transfer_reason',
                'identifier_name', 'identifier_nid', 'identifier_address',
                'status', 'purpose'
            ]);
        });
    }
};
