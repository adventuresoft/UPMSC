@extends('backend.master', ['mainMenu' => 'Dashboard', 'subMenu' =>'dashboard'])
@section('title', 'Dashboard')

@push('style')
<style>
    .dashboard-card-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        width: 100%;
    }

    .dashboard-stat-card {
        position: relative;
        display: flex;
        min-height: 142px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 8px 22px rgba(15, 23, 42, 0.06);
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    }

    .dashboard-stat-card:hover {
        transform: translateY(-2px);
        border-color: #cbd5e1;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.1);
    }

    .dashboard-stat-card::before {
        content: "";
        position: absolute;
        inset: 0 auto 0 0;
        width: 5px;
        background: var(--card-accent, #046307);
    }

    .dashboard-stat-card .card-content {
        display: flex;
        flex: 1;
        flex-direction: column;
        justify-content: space-between;
        min-width: 0;
        padding: 18px 18px 0 22px;
    }

    .dashboard-stat-card .card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
    }

    .dashboard-stat-card .card-number {
        margin: 0;
        color: #0f172a;
        font-size: 34px;
        font-weight: 700;
        line-height: 1;
    }

    .dashboard-stat-card .card-title {
        margin: 8px 0 0;
        color: #475569;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.3;
    }

    .dashboard-stat-card .card-icon {
        display: inline-flex;
        flex: 0 0 auto;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        border-radius: 8px;
        background: #f8fafc;
        color: var(--card-accent, #046307);
        font-size: 22px;
    }

    .dashboard-stat-card .card-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin: 16px -18px 0 -22px;
        padding: 10px 18px 10px 22px;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        color: #0f172a;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .dashboard-stat-card .card-link:hover {
        color: var(--card-accent, #046307);
    }

    @media (max-width: 991.98px) {
        .dashboard-card-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }
    }

    @media (max-width: 575.98px) {
        .dashboard-card-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
    }
</style>
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header pt-4 pb-3">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-12 text-left">
                    <h1 class="m-0" style="color: #1a237e; font-size: 1.45rem; font-weight: 500; letter-spacing: 0.3px;">
                        Welcome to <span style="color: #046307;">Certificate and License Management Solution</span>
                    </h1>
                    
                    <hr style="width: 80px; border-top: 3px solid #f59e0b; margin: 12px 0 0;">
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header ---->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @php
                $total = $age_certificates + $character_certificates + $childless_certificates + $citizen_certificates + $disability_certificates + $financial_instability_certificates + $guardian_certificates + $landless_certificates + $married_certificates + $name_certificates + $nid_correction_certificates + $orphan_certificates + $permanent_citizen_certificates + $remarried_certificates + $residential_certificates + $unmarried_certificates + $voter_area_certificates + $voter_list_certificates + $yearly_income_certificates;
                $dashboardCards = [
                    ['value' => $applicant_count, 'title' => 'Applicant List', 'icon' => 'fa fa-user-clock', 'route' => route('people.index'), 'link' => 'View Applicant List', 'accent' => '#f59e0b'],
                    ['value' => $approved_count, 'title' => 'Approved People', 'icon' => 'fa fa-user-check', 'route' => route('peopleapprovedlist'), 'link' => 'View Approved List', 'accent' => '#16a34a'],
                    ['value' => $total, 'title' => 'Total Certificates', 'icon' => 'fa fa-certificate', 'route' => route('citizen.index'), 'link' => 'View All Certificates', 'accent' => '#64748b'],
                    ['value' => $taxes, 'title' => 'Total Tax', 'icon' => 'fa fa-id-card', 'route' => route('tax.index'), 'link' => 'View All Taxes', 'accent' => '#0891b2'],
                    ['value' => $organizations, 'title' => 'Total Organization', 'icon' => 'fas fa-briefcase', 'route' => route('organization.index'), 'link' => 'View All Organizations', 'accent' => '#dc2626'],
                    ['value' => $houses, 'title' => 'Total House', 'icon' => 'fa fa-home', 'route' => route('house.index'), 'link' => 'View All Houses', 'accent' => '#2563eb'],
                    ['value' => $vehicles, 'title' => 'Total Vehicle', 'icon' => 'fas fa-truck', 'route' => route('vehicle.index'), 'link' => 'View All Vehicles', 'accent' => '#059669'],
                    ['value' => $relief_cards, 'title' => 'Total Relief Cards', 'icon' => 'fa fa-hand-holding-heart', 'route' => route('relief-card.index'), 'link' => 'View Relief Cards', 'accent' => '#ec4899'],
                ];
            @endphp

            <div class="dashboard-card-grid">
                @foreach($dashboardCards as $card)
                    <div class="dashboard-stat-card" style="--card-accent: {{ $card['accent'] }}">
                        <div class="card-content">
                            <div class="card-top">
                                <div>
                                    <h3 class="card-number">{{ $card['value'] }}</h3>
                                    <p class="card-title">{{ $card['title'] }}</p>
                                </div>
                                <span class="card-icon" aria-hidden="true">
                                    <i class="{{ $card['icon'] }}"></i>
                                </span>
                            </div>
                            <a href="{{ $card['route'] }}" class="card-link">
                                <span>{{ $card['link'] }}</span>
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
