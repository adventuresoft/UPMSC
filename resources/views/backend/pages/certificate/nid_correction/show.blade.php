@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'NidCorrection'])
@push('style')
<style>
    .info-table th { width: 30%; background-color: #f8f9fa; }
    .section-header { background-color: #17a2b8; color: white; padding: 10px; margin-top: 20px; border-radius: 5px; }
</style>
@endpush

@section('title', 'Voter Transfer Details')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">ভোটার স্থানান্তর আবেদন বিস্তারিত (ফরম-১৩)</h3>
                    <div>
                        <a href="{{ route('nid-correction.index') }}" class="btn btn-sm btn-light">Back to List</a>
                        <a href="{{ route('nid-correction.bn_certificate', $certificate->id) }}" class="btn btn-sm btn-warning">View PDF/Form</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <strong>আবেদন নম্বর:</strong> {{ bnValue($certificate->system_id) }}
                        </div>
                        <div class="col-md-6 text-right">
                            আবেদনের তারিখ: {{ bnValue(date('d/m/Y', strtotime($certificate->created_at))) }}
                        </div>
                    </div>

                    <h5 class="section-header">১. আবেদনকারীর তথ্য</h5>
                    <table class="table table-bordered info-table">
                        <tr>
                            <th>আবেদনকারীর নাম</th>
                            <td>{{ $certificate->applicant_name }}</td>
                        </tr>
                        <tr>
                            <th>জাতীয় পরিচয়পত্র নম্বর (NID)</th>
                            <td>{{ bnValue($certificate->applicant_nid) }}</td>
                        </tr>
                        <tr>
                            <th>জন্ম তারিখ</th>
                            <td>{{ $certificate->applicant_dob ? bnValue(date('d/m/Y', strtotime($certificate->applicant_dob))) : '--' }}</td>
                        </tr>
                        <tr>
                            <th>প্রাপক অফিসার</th>
                            <td>{{ $certificate->recipient_upazila_thana_name }}, {{ $certificate->recipient_district }}</td>
                        </tr>
                    </table>

                    <h5 class="section-header">২. বর্তমান তালিকাভুক্তি সংক্রান্ত তথ্যাদি</h5>
                    <table class="table table-bordered info-table">
                        <tr>
                            <th>ভোটার নম্বর</th>
                            <td>{{ bnValue($certificate->current_voter_no) }}</td>
                        </tr>
                        <tr>
                            <th>ভোটার এলাকা</th>
                            <td>{{ $certificate->current_voter_area_name }} (নম্বর: {{ bnValue($certificate->current_voter_area_no) }})</td>
                        </tr>
                        <tr>
                            <th>উপজেলা/থানা ও জেলা</th>
                            <td>{{ $certificate->current_upazila_thana }}, {{ $certificate->current_district }}</td>
                        </tr>
                        <tr>
                            <th>বর্তমান ঠিকানা</th>
                            <td>{{ $certificate->current_village_road }}, বাসা/হোল্ডিং: {{ bnValue($certificate->current_house_holding) }}</td>
                        </tr>
                    </table>

                    <h5 class="section-header">৩. স্থানান্তরের গন্তব্য তথ্য</h5>
                    <table class="table table-bordered info-table">
                        <tr>
                            <th>গন্তব্য জেলা ও উপজেলা</th>
                            <td>{{ $certificate->transfer_district }}, {{ $certificate->transfer_upazila_thana }}</td>
                        </tr>
                        <tr>
                            <th>গন্তব্য এলাকা ({{ $certificate->transfer_entity_type }})</th>
                            <td>{{ $certificate->transfer_entity_name }}, ওয়ার্ড: {{ bnValue($certificate->transfer_ward_no) }}</td>
                        </tr>
                        <tr>
                            <th>গন্তব্য ভোটার এলাকা</th>
                            <td>{{ $certificate->transfer_voter_area_name }} (নম্বর: {{ bnValue($certificate->transfer_voter_area_no) }})</td>
                        </tr>
                        <tr>
                            <th>গন্তব্য ঠিকানা</th>
                            <td>{{ $certificate->transfer_village_road }}, বাসা/হোল্ডিং: {{ bnValue($certificate->transfer_house_holding) }}</td>
                        </tr>
                        <tr>
                            <th>ডাকঘর ও পোস্ট কোড</th>
                            <td>{{ $certificate->transfer_post_office }} ({{ bnValue($certificate->transfer_post_code) }})</td>
                        </tr>
                        <tr>
                            <th>মোবাইল নম্বর</th>
                            <td>{{ bnValue($certificate->transfer_phone_mobile) }}</td>
                        </tr>
                    </table>

                    <h5 class="section-header">৪. অতিরিক্ত তথ্য ও সনাক্তকারী</h5>
                    <table class="table table-bordered info-table">
                        <tr>
                            <th>অবস্থানের সময়</th>
                            <td>{{ $certificate->staying_since }}</td>
                        </tr>
                        <tr>
                            <th>স্থানান্তরের কারণ</th>
                            <td>{{ $certificate->transfer_reason }}</td>
                        </tr>
                        <tr>
                            <th>সনাক্তকারীর তথ্য</th>
                            <td>
                                <strong>নাম:</strong> {{ $certificate->identifier_name }} <br>
                                <strong>NID:</strong> {{ bnValue($certificate->identifier_nid) }} <br>
                                <strong>ঠিকানা:</strong> {{ $certificate->identifier_address }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-success" onclick="window.print()">Print Details</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@endpush
