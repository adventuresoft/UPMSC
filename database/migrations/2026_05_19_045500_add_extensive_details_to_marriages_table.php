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
        Schema::table('marriages', function (Blueprint $table) {
            if (!Schema::hasColumn('marriages', 'registration_no')) {
                $table->string('registration_no')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'marriage_type')) {
                $table->string('marriage_type')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'marriage_date')) {
                $table->date('marriage_date')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'registration_date')) {
                $table->date('registration_date')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'marriage_place')) {
                $table->string('marriage_place')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'marriage_area_type')) {
                $table->string('marriage_area_type')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'division_id')) {
                $table->unsignedBigInteger('division_id')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'district_id')) {
                $table->unsignedBigInteger('district_id')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'upazila_id')) {
                $table->unsignedBigInteger('upazila_id')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'union_id')) {
                $table->unsignedBigInteger('union_id')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'ward_no')) {
                $table->string('ward_no')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'village_area')) {
                $table->string('village_area')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'post_office')) {
                $table->string('post_office')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'post_code')) {
                $table->string('post_code')->nullable();
            }

            // Groom
            if (!Schema::hasColumn('marriages', 'groom_user_id')) {
                $table->unsignedBigInteger('groom_user_id')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'groom_name')) {
                $table->string('groom_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'groom_father_name')) {
                $table->string('groom_father_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'groom_mother_name')) {
                $table->string('groom_mother_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'groom_dob')) {
                $table->date('groom_dob')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'groom_age')) {
                $table->integer('groom_age')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'groom_nid')) {
                $table->string('groom_nid')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'groom_religion')) {
                $table->string('groom_religion')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'groom_occupation')) {
                $table->string('groom_occupation')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'groom_mobile')) {
                $table->string('groom_mobile')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'groom_marital_status')) {
                $table->string('groom_marital_status')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'groom_present_address')) {
                $table->text('groom_present_address')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'groom_permanent_address')) {
                $table->text('groom_permanent_address')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'groom_photo')) {
                $table->string('groom_photo')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'groom_signature')) {
                $table->string('groom_signature')->nullable();
            }

            // Bride
            if (!Schema::hasColumn('marriages', 'bride_user_id')) {
                $table->unsignedBigInteger('bride_user_id')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'bride_name')) {
                $table->string('bride_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'bride_father_name')) {
                $table->string('bride_father_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'bride_mother_name')) {
                $table->string('bride_mother_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'bride_dob')) {
                $table->date('bride_dob')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'bride_age')) {
                $table->integer('bride_age')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'bride_nid')) {
                $table->string('bride_nid')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'bride_religion')) {
                $table->string('bride_religion')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'bride_occupation')) {
                $table->string('bride_occupation')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'bride_mobile')) {
                $table->string('bride_mobile')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'bride_marital_status')) {
                $table->string('bride_marital_status')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'bride_present_address')) {
                $table->text('bride_present_address')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'bride_permanent_address')) {
                $table->text('bride_permanent_address')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'bride_photo')) {
                $table->string('bride_photo')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'bride_signature')) {
                $table->string('bride_signature')->nullable();
            }

            // Witnesses
            if (!Schema::hasColumn('marriages', 'witness_1_name')) {
                $table->string('witness_1_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'witness_1_nid')) {
                $table->string('witness_1_nid')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'witness_1_mobile')) {
                $table->string('witness_1_mobile')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'witness_1_address')) {
                $table->text('witness_1_address')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'witness_1_signature')) {
                $table->string('witness_1_signature')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'witness_2_name')) {
                $table->string('witness_2_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'witness_2_nid')) {
                $table->string('witness_2_nid')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'witness_2_mobile')) {
                $table->string('witness_2_mobile')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'witness_2_address')) {
                $table->text('witness_2_address')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'witness_2_signature')) {
                $table->string('witness_2_signature')->nullable();
            }

            // Islamic
            if (!Schema::hasColumn('marriages', 'islam_kabin_number')) {
                $table->string('islam_kabin_number')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'islam_den_mohor_amount')) {
                $table->string('islam_den_mohor_amount')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'islam_den_mohor_type')) {
                $table->string('islam_den_mohor_type')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'islam_bride_wakil_name')) {
                $table->string('islam_bride_wakil_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'islam_groom_wakil_name')) {
                $table->string('islam_groom_wakil_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'islam_kazi_name')) {
                $table->string('islam_kazi_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'islam_kazi_license_no')) {
                $table->string('islam_kazi_license_no')->nullable();
            }

            // Hindu
            if (!Schema::hasColumn('marriages', 'hindu_temple_name')) {
                $table->string('hindu_temple_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'hindu_purohit_name')) {
                $table->string('hindu_purohit_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'hindu_marriage_ritual_date')) {
                $table->date('hindu_marriage_ritual_date')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'hindu_bride_gotra')) {
                $table->string('hindu_bride_gotra')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'hindu_groom_gotra')) {
                $table->string('hindu_groom_gotra')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'hindu_saptapadi_completed')) {
                $table->string('hindu_saptapadi_completed')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'hindu_sacred_fire_ceremony')) {
                $table->string('hindu_sacred_fire_ceremony')->nullable();
            }

            // Christian
            if (!Schema::hasColumn('marriages', 'christian_church_name')) {
                $table->string('christian_church_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'christian_pastor_name')) {
                $table->string('christian_pastor_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'christian_marriage_license_no')) {
                $table->string('christian_marriage_license_no')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'christian_publication_of_banns')) {
                $table->string('christian_publication_of_banns')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'christian_marriage_conducted_by')) {
                $table->string('christian_marriage_conducted_by')->nullable();
            }

            // Other
            if (!Schema::hasColumn('marriages', 'other_religion_name')) {
                $table->string('other_religion_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'other_religious_leader_name')) {
                $table->string('other_religious_leader_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'other_ceremony_type')) {
                $table->string('other_ceremony_type')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'other_organization_name')) {
                $table->string('other_organization_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'other_other_details')) {
                $table->text('other_other_details')->nullable();
            }

            // Docs
            if (!Schema::hasColumn('marriages', 'doc_groom_nid')) {
                $table->string('doc_groom_nid')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'doc_bride_nid')) {
                $table->string('doc_bride_nid')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'doc_birth_certificate')) {
                $table->string('doc_birth_certificate')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'doc_passport_photo')) {
                $table->string('doc_passport_photo')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'doc_witness_nid')) {
                $table->string('doc_witness_nid')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'doc_marriage_certificate_scan')) {
                $table->string('doc_marriage_certificate_scan')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'doc_other')) {
                $table->string('doc_other')->nullable();
            }

            // Registrar/Kazi
            if (!Schema::hasColumn('marriages', 'registrar_name')) {
                $table->string('registrar_name')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'registrar_license')) {
                $table->string('registrar_license')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'registrar_office_address')) {
                $table->text('registrar_office_address')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'registrar_office_seal')) {
                $table->string('registrar_office_seal')->nullable();
            }
            if (!Schema::hasColumn('marriages', 'registrar_signature')) {
                $table->string('registrar_signature')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marriages', function (Blueprint $table) {
            //
        });
    }
};
