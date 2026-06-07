@extends('backend.master', ['mainMenu' => 'chairman', 'subMenu' =>'panelList'])
@push('style')
<style>
/* No external @import - use system + existing fonts */
.panel-container {
    background: linear-gradient(to bottom, #d6e0df, #eaf0f0);
    padding: 40px 20px 60px;
    font-family: 'Source Sans Pro', sans-serif;
}
.panel-header {
    text-align: center;
    margin-bottom: 40px;
}
.logo-box {
    display: inline-block;
    background: #fff;
    border-top: 4px solid #e11d48;
    padding: 12px 25px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
    margin-bottom: 18px;
    border-radius: 4px;
}
.logo-box img {
    height: 65px;
    max-width: 220px;
    object-fit: contain;
}
.union-ribbon {
    background: linear-gradient(to bottom, #f43f5e, #be123c);
    color: white;
    display: inline-block;
    padding: 14px 45px;
    font-size: 26px;
    font-weight: 900;
    text-transform: uppercase;
    box-shadow: 0 8px 18px rgba(0,0,0,0.22);
    letter-spacing: 2px;
    border: 3px solid #fff;
    border-radius: 4px;
}
/* Cards Grid - 4 per row */
.panel-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 30px 25px;
    max-width: 1400px;
    margin: 0 auto;
    justify-content: center;
    align-items: stretch;
}
/* Make all cards fill the grid cell height */
.panel-grid .member-card {
    height: 100%;
    flex-shrink: 0;
}
/* Section title spans all 4 columns */
.section-title {
    grid-column: 1 / -1;
    width: 100%;
    text-align: center;
    margin: 24px 0 8px 0;
    font-size: 22px;
    font-weight: 800;
    color: #111827;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-bottom: 2px solid #cbd5e1;
    padding-bottom: 10px;
}
/* Member card */
.member-card {
    background: #fff;
    position: relative;
    display: flex;
    flex-direction: column;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    transition: transform 0.25s;
    border-radius: 4px;
    overflow: hidden;
    width: 100%;
}
/* Chairman card - largest */
.chairman-card {
    max-width: 280px;
}
/* Panel Chairman card - medium */
.panel-chairman-card {
    max-width: 250px;
}
/* Regular and Reserve member cards - smallest */
.regular-member-card,
.reserve-member-card {
    max-width: 200px;
}
.member-card:hover { transform: translateY(-5px); }
/* Special badge for chairman */
.chairman-badge {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    background: linear-gradient(to bottom, #4d7c0f, #365314);
    color: white;
    min-width: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
    font-size: 16px;
    letter-spacing: 2px;
    writing-mode: vertical-rl;
    transform: rotate(180deg);
    text-align: center;
    padding: 10px 0;
    z-index: 10;
    box-shadow: 2px 0 10px rgba(0,0,0,0.2);
}
/* Adjust badge size for chairman card */
.chairman-card .chairman-badge {
    min-width: 55px;
    font-size: 17px;
}
/* Adjust badge size for panel chairman card */
.panel-chairman-card .chairman-badge {
    min-width: 50px;
    font-size: 16px;
}
/* Special badge for panel chairman */
.panel-chair-badge {
    background: linear-gradient(to bottom, #0f766e, #042f2e);
}
/* Special badge for regular member */
.member-badge {
    background: linear-gradient(to bottom, #1d4ed8, #1e3a8a);
}
/* Special badge for reserve member */
.reserve-badge {
    background: linear-gradient(to bottom, #db2777, #9d174d);
}
.card-photo-bg {
    height: 240px;
    width: 100%;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: flex-end;
    justify-content: center;
}
.bg-green  { background: linear-gradient(to bottom, #a3e635, #65a30d); }
.bg-blue   { background: linear-gradient(to bottom, #38bdf8, #0284c7); }
.bg-purple { background: linear-gradient(to bottom, #c084fc, #9333ea); }
.bg-pink   { background: linear-gradient(to bottom, #f472b6, #db2777); }
.bg-orange { background: linear-gradient(to bottom, #fb923c, #ea580c); }
.bg-teal   { background: linear-gradient(to bottom, #2dd4bf, #0f766e); }
.bg-gray   { background: linear-gradient(to bottom, #9ca3af, #4b5563); }
.card-photo-bg img {
    height: 93%;
    width: 100%;
    object-fit: cover;
    object-position: top center;
    filter: drop-shadow(0 10px 12px rgba(0,0,0,0.25));
    z-index: 2;
}
.card-info {
    background: white;
    padding: 12px 10px;
    text-align: center;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.member-name {
    font-size: 13px;
    font-weight: 800;
    color: #e11d48;
    text-transform: uppercase;
    margin: 0 0 4px 0;
    line-height: 1.2;
}
.member-desig {
    font-size: 14px;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
}
</style>
@endpush

@section('title', 'Panel Hierarchy')
@section('content')
  <!-- Content Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Panel Hierarchy</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('chairman.panelList') }}">Panel</a></li>
            <li class="breadcrumb-item active">View</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          @php $bgColors = ['bg-blue','bg-purple','bg-pink','bg-orange','bg-teal','bg-gray']; @endphp
          @php $noImg = asset('default.png'); @endphp

          @php
              // Collect all members from all councils in hierarchy order
              $all_chairmen = collect();
              $all_panel_chairmen = collect();
              $all_regular_members = collect();
              $all_reserve_members = collect();

              foreach($councils as $council) {
                  $chairman = $members->where('council_id', $council->id)->where('concilor_designation_id', 1)->first();
                  if($chairman) $all_chairmen->push($chairman);

                  $panel_chairman = $members->where('council_id', $council->id)->where('concilor_designation_id', 4)->first();
                  if($panel_chairman) $all_panel_chairmen->push($panel_chairman);

                  $regular_members = $members->where('council_id', $council->id)->where('concilor_designation_id', 2)->values();
                  $all_regular_members = $all_regular_members->merge($regular_members);

                  $reserve_members = $members->where('council_id', $council->id)->where('concilor_designation_id', 3)->values();
                  $all_reserve_members = $all_reserve_members->merge($reserve_members);
              }

              // Get first council for logo
              $first_council = $councils->first();
              $institute = $institutes[$first_council->union_id] ?? null;
              if ($institute && $institute->left_image) {
                  $logoUrl = imageUrl($institute->left_image);
              } elseif ($institute && $institute->top_image) {
                  $logoUrl = imageUrl($institute->top_image);
              } else {
                  $logoUrl = asset('assets/images/logo/govt-bd-logo.png');
              }
          @endphp

          <div class="panel-container mb-5">

            <!-- Header: Logo + Union Name -->
            <div class="panel-header">
              <div class="logo-box">
                <img src="{{ $logoUrl }}" alt="Union Logo" onerror="this.onerror=null;this.src='{{ $noImg }}'">
              </div>
              <br>
              <div class="union-ribbon">
                UNION PANEL
              </div>
            </div>

            <div class="panel-grid">

              <!-- All Chairmen -->
              @if($all_chairmen->count() > 0)
              @foreach($all_chairmen as $chairman)
              <div class="member-card chairman-card">
                <div class="chairman-badge">CHAIRMAN</div>
                <div class="card-photo-bg bg-green">
                  <img src="{{ $chairman->user->image ? imageUrl($chairman->user->image) : $noImg }}"
                       alt="Chairman"
                       onerror="this.onerror=null;this.src='{{ $noImg }}'">
                </div>
                <div class="card-info">
                  <p class="member-name">{{ $chairman->user->name ?? 'N/A' }}</p>
                  <p class="member-desig">Chairman / Mayor</p>
                </div>
              </div>
              @endforeach
              @endif

              <!-- All Panel Chairmen -->
              @if($all_panel_chairmen->count() > 0)
              @foreach($all_panel_chairmen as $panel_chairman)
              <div class="member-card panel-chairman-card">
                <div class="chairman-badge panel-chair-badge">PANEL CHAIR</div>
                <div class="card-photo-bg bg-teal">
                  <img src="{{ $panel_chairman->user->image ? imageUrl($panel_chairman->user->image) : $noImg }}"
                       alt="Panel Chairman"
                       onerror="this.onerror=null;this.src='{{ $noImg }}'">
                </div>
                <div class="card-info">
                  <p class="member-name">{{ $panel_chairman->user->name ?? 'N/A' }}</p>
                  <p class="member-desig">Panel Chairman</p>
                </div>
              </div>
              @endforeach
              @endif

              <!-- All Regular Members (4 per row) -->
              @if($all_regular_members->count() > 0)
              @foreach($all_regular_members as $index => $rm)
              <div class="member-card regular-member-card">
                <div class="chairman-badge member-badge">MEMBER</div>
                <div class="card-photo-bg {{ $bgColors[$index % count($bgColors)] }}">
                  <img src="{{ $rm->user->image ? imageUrl($rm->user->image) : $noImg }}"
                       alt="Member"
                       onerror="this.onerror=null;this.src='{{ $noImg }}'">
                </div>
                <div class="card-info">
                  <p class="member-name">{{ $rm->user->name ?? 'N/A' }}</p>
                  <p class="member-desig">{{ $rm->word_no_text ?: 'Member' }}</p>
                </div>
              </div>
              @endforeach
              @endif

              <!-- All Reserve Members (4 per row) -->
              @if($all_reserve_members->count() > 0)
              @foreach($all_reserve_members as $index => $rwm)
              <div class="member-card reserve-member-card">
                <div class="chairman-badge reserve-badge">RESERVE</div>
                <div class="card-photo-bg {{ $bgColors[($index + 2) % count($bgColors)] }}">
                  <img src="{{ $rwm->user->image ? imageUrl($rwm->user->image) : $noImg }}"
                       alt="Reserve Member"
                       onerror="this.onerror=null;this.src='{{ $noImg }}'">
                </div>
                <div class="card-info">
                  <p class="member-name">{{ $rwm->user->name ?? 'N/A' }}</p>
                  <p class="member-desig">{{ $rwm->word_no_text ?: 'Reserve Member' }}</p>
                </div>
              </div>
              @endforeach
              @endif

            </div><!-- /.panel-grid -->
          </div><!-- /.panel-container -->

        </div>
      </div>
    </div>
  </section>
@endsection
@push('script')
@endpush
