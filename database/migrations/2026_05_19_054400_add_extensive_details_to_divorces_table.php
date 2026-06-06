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
        Schema::table('divorces', function (Blueprint $table) {
            if (!Schema::hasColumn('divorces', 'registration_no')) {
                $table->string('registration_no')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'divorce_type')) {
                $table->string('divorce_type')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'divorce_date')) {
                $table->date('divorce_date')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'registration_date')) {
                $table->date('registration_date')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'divorce_place')) {
                $table->string('divorce_place')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'divorce_area_type')) {
                $table->string('divorce_area_type')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'division_id')) {
                $table->unsignedBigInteger('division_id')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'district_id')) {
                $table->unsignedBigInteger('district_id')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'upazila_id')) {
                $table->unsignedBigInteger('upazila_id')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'union_id')) {
                $table->unsignedBigInteger('union_id')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'ward_no')) {
                $table->string('ward_no')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'village_area')) {
                $table->string('village_area')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'post_office')) {
                $table->string('post_office')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'post_code')) {
                $table->string('post_code')->nullable();
            }

            // Husband
            if (!Schema::hasColumn('divorces', 'husband_user_id')) {
                $table->unsignedBigInteger('husband_user_id')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'husband_name')) {
                $table->string('husband_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'husband_father_name')) {
                $table->string('husband_father_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'husband_mother_name')) {
                $table->string('husband_mother_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'husband_dob')) {
                $table->date('husband_dob')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'husband_age')) {
                $table->integer('husband_age')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'husband_nid')) {
                $table->string('husband_nid')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'husband_religion')) {
                $table->string('husband_religion')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'husband_occupation')) {
                $table->string('husband_occupation')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'husband_mobile')) {
                $table->string('husband_mobile')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'husband_marital_status')) {
                $table->string('husband_marital_status')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'husband_present_address')) {
                $table->text('husband_present_address')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'husband_permanent_address')) {
                $table->text('husband_permanent_address')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'husband_photo')) {
                $table->string('husband_photo')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'husband_signature')) {
                $table->string('husband_signature')->nullable();
            }

            // Wife
            if (!Schema::hasColumn('divorces', 'wife_user_id')) {
                $table->unsignedBigInteger('wife_user_id')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'wife_name')) {
                $table->string('wife_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'wife_father_name')) {
                $table->string('wife_father_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'wife_mother_name')) {
                $table->string('wife_mother_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'wife_dob')) {
                $table->date('wife_dob')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'wife_age')) {
                $table->integer('wife_age')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'wife_nid')) {
                $table->string('wife_nid')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'wife_religion')) {
                $table->string('wife_religion')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'wife_occupation')) {
                $table->string('wife_occupation')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'wife_mobile')) {
                $table->string('wife_mobile')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'wife_marital_status')) {
                $table->string('wife_marital_status')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'wife_present_address')) {
                $table->text('wife_present_address')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'wife_permanent_address')) {
                $table->text('wife_permanent_address')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'wife_photo')) {
                $table->string('wife_photo')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'wife_signature')) {
                $table->string('wife_signature')->nullable();
            }

            // Witnesses
            if (!Schema::hasColumn('divorces', 'witness_1_name')) {
                $table->string('witness_1_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'witness_1_nid')) {
                $table->string('witness_1_nid')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'witness_1_mobile')) {
                $table->string('witness_1_mobile')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'witness_1_address')) {
                $table->text('witness_1_address')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'witness_1_signature')) {
                $table->string('witness_1_signature')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'witness_2_name')) {
                $table->string('witness_2_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'witness_2_nid')) {
                $table->string('witness_2_nid')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'witness_2_mobile')) {
                $table->string('witness_2_mobile')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'witness_2_address')) {
                $table->text('witness_2_address')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'witness_2_signature')) {
                $table->string('witness_2_signature')->nullable();
            }

            // Islamic specific
            if (!Schema::hasColumn('divorces', 'islam_kabin_number')) {
                $table->string('islam_kabin_number')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'islam_den_mohor_amount')) {
                $table->string('islam_den_mohor_amount')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'islam_den_mohor_type')) {
                $table->string('islam_den_mohor_type')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'islam_wife_wakil_name')) {
                $table->string('islam_wife_wakil_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'islam_husband_wakil_name')) {
                $table->string('islam_husband_wakil_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'islam_kazi_name')) {
                $table->string('islam_kazi_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'islam_kazi_license_no')) {
                $table->string('islam_kazi_license_no')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'islam_divorce_reason')) {
                $table->text('islam_divorce_reason')->nullable();
            }

            // Hindu specific
            if (!Schema::hasColumn('divorces', 'hindu_temple_name')) {
                $table->string('hindu_temple_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'hindu_purohit_name')) {
                $table->string('hindu_purohit_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'hindu_marriage_ritual_date')) {
                $table->date('hindu_marriage_ritual_date')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'hindu_wife_gotra')) {
                $table->string('hindu_wife_gotra')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'hindu_husband_gotra')) {
                $table->string('hindu_husband_gotra')->nullable();
            }

            // Christian specific
            if (!Schema::hasColumn('divorces', 'christian_church_name')) {
                $table->string('christian_church_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'christian_pastor_name')) {
                $table->string('christian_pastor_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'christian_marriage_license_no')) {
                $table->string('christian_marriage_license_no')->nullable();
            }

            // Other
            if (!Schema::hasColumn('divorces', 'other_religion_name')) {
                $table->string('other_religion_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'other_religious_leader_name')) {
                $table->string('other_religious_leader_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'other_ceremony_type')) {
                $table->string('other_ceremony_type')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'other_organization_name')) {
                $table->string('other_organization_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'other_other_details')) {
                $table->text('other_other_details')->nullable();
            }

            // Docs
            if (!Schema::hasColumn('divorces', 'doc_husband_nid')) {
                $table->string('doc_husband_nid')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'doc_wife_nid')) {
                $table->string('doc_wife_nid')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'doc_birth_certificate')) {
                $table->string('doc_birth_certificate')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'doc_divorce_paper_scan')) {
                $table->string('doc_divorce_paper_scan')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'doc_other')) {
                $table->string('doc_other')->nullable();
            }

            // Registrar/Kazi
            if (!Schema::hasColumn('divorces', 'registrar_name')) {
                $table->string('registrar_name')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'registrar_license')) {
                $table->string('registrar_license')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'registrar_office_address')) {
                $table->text('registrar_office_address')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'registrar_office_seal')) {
                $table->string('registrar_office_seal')->nullable();
            }
            if (!Schema::hasColumn('divorces', 'registrar_signature')) {
                $table->string('registrar_signature')->nullable();
            }

            // Status
            if (!Schema::hasColumn('divorces', 'status')) {
                $table->integer('status')->default(1);
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
        Schema::table('divorces', function (Blueprint $table) {
            //
        });
    }
};
