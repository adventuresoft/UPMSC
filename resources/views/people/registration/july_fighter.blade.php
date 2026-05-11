@extends('frontend.master')

@section('title', 'জুলাই ২৪ যোদ্ধা তথ্য')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 pb-0 pt-4">
                    @include('people.registration.tab_header', ['user' => $user, 'active_tab' => 'july_fighter'])
                </div>
                
                <div class="card-body px-4 pb-4">
                    <form id="julyFighterForm" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        
                        <div class="p-4 bg-light rounded-lg mb-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-indigo-soft p-3 rounded-circle mr-3">
                                    <i class="fas fa-fist-raised text-indigo fa-lg"></i>
                                </div>
                                <div>
                                    <h4 class="mb-0 font-weight-bold text-dark">জুলাই ২৪ যোদ্ধা তথ্য</h4>
                                    <p class="text-muted small mb-0">ঐতিহাসিক জুলাই ২৪ আন্দোলনে আপনার অংশগ্রহণের তথ্য প্রদান করুন</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <div class="custom-control custom-switch custom-switch-lg">
                                        <input type="checkbox" class="custom-control-input" id="is_july_fighter" name="is_july_fighter" value="1" {{ optional($user->julyFighterInfo)->is_july_fighter ? 'checked' : '' }}>
                                        <label class="custom-control-label font-weight-bold text-indigo" for="is_july_fighter">আপনি কি জুলাই ২৪ যোদ্ধা?</label>
                                    </div>
                                </div>
                            </div>

                            <div id="july_fighter_details" style="{{ optional($user->julyFighterInfo)->is_july_fighter ? '' : 'display: none;' }}">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label font-weight-bold small text-uppercase text-muted">যোদ্ধার ধরন</label>
                                        <select name="fighter_type" class="form-control form-control-lg border-0 shadow-sm">
                                            <option value="">নির্বাচন করুন</option>
                                            <option value="Martyr" {{ optional($user->julyFighterInfo)->fighter_type == 'Martyr' ? 'selected' : '' }}>শহীদ</option>
                                            <option value="Injured" {{ optional($user->julyFighterInfo)->fighter_type == 'Injured' ? 'selected' : '' }}>আহত</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label font-weight-bold small text-uppercase text-muted">ঘটনার স্থান</label>
                                        <input type="text" name="incident_location" value="{{ optional($user->julyFighterInfo)->incident_location }}" class="form-control form-control-lg border-0 shadow-sm" placeholder="উদা: ঢাকা, চট্টগ্রাম, ইত্যাদি">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label font-weight-bold small text-uppercase text-muted">আঘাতের বিবরণ (যদি থাকে)</label>
                                        <input type="text" name="injury_details" value="{{ optional($user->julyFighterInfo)->injury_details }}" class="form-control form-control-lg border-0 shadow-sm" placeholder="আপনার আঘাতের বিবরণ লিখুন...">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label font-weight-bold small text-uppercase text-muted">অবদানের বিবরণ</label>
                                        <textarea name="contribution_description" rows="4" class="form-control border-0 shadow-sm" placeholder="আপনার অবদানের সংক্ষিপ্ত বিবরণ লিখুন...">{{ optional($user->julyFighterInfo)->contribution_description }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-top-0 px-0 pt-3">
                            <div class="row align-items-center">
                                <div class="col-sm-6 mb-2 mb-sm-0">
                                    <a href="{{ route('people.applications.registration.freedom', $user->id) }}" class="btn btn-outline-secondary btn-lg btn-block shadow-sm">
                                        <i class="fas fa-arrow-left mr-2"></i> মুক্তিযোদ্ধা তথ্য
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block shadow-sm btn-indigo">
                                        <i class="fas fa-check-circle mr-2"></i> সম্পন্ন করুন
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-indigo-soft { background-color: #eef2ff; }
    .text-indigo { color: #4f46e5; }
    .btn-indigo { background-color: #4f46e5; border-color: #4f46e5; }
    .btn-indigo:hover { background-color: #4338ca; border-color: #4338ca; }
    .custom-switch-lg { padding-left: 3.25rem; }
    .custom-switch-lg .custom-control-label::before { left: -3.25rem; height: 1.5rem; width: 2.75rem; border-radius: 1rem; }
    .custom-switch-lg .custom-control-label::after { left: calc(-3.25rem + 2px); width: calc(1.5rem - 4px); height: calc(1.5rem - 4px); border-radius: 1rem; }
    .custom-switch-lg .custom-control-input:checked ~ .custom-control-label::after { transform: translateX(1.25rem); }
</style>

@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('#is_july_fighter').change(function() {
            if($(this).is(':checked')) {
                $('#july_fighter_details').slideDown();
            } else {
                $('#july_fighter_details').slideUp();
            }
        });

        $('#julyFighterForm').on('submit', function(e) {
            e.preventDefault();
            let btn = $(this).find('button[type="submit"]');
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> সংরক্ষণ করা হচ্ছে...');
            
            $.ajax({
                type: "POST",
                url: "{{ route('people.applications.registration.julyFighterStore') }}",
                data: $(this).serialize(),
                success: function(response) {
                    if(response.status) {
                        toastr.success(response.message);
                        setTimeout(() => {
                            window.location.href = response.redirect_url;
                        }, 2000);
                    }
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html('<i class="fas fa-check-circle mr-2"></i> সম্পন্ন করুন');
                    toastr.error('ত্রুটি হয়েছে, পুনরায় চেষ্টা করুন।');
                }
            });
        });
    });
</script>
@endpush
