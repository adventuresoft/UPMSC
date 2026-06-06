@extends('backend.master', ['mainMenu' => 'chairman', 'subMenu' =>'panelList'])
@push('style')
<style>
/* No external @import - use system + existing fonts */
.panel-container {
    background: white;
    padding: 20px 20px 60px;
    font-family: 'Source Sans Pro', sans-serif;
}
.union-selector {
    max-width: 1200px;
    margin: 0 auto 30px;
    padding: 15px;
    background: #f4f6f9;
    border-radius: 8px;
    text-align: center;
}
.union-selector label {
    font-weight: 600;
    margin-right: 10px;
}
.union-selector select {
    padding: 8px 15px;
    border-radius: 4px;
    border: 1px solid #ced4da;
    min-width: 250px;
}
.union-selector button {
    padding: 8px 20px;
    margin-left: 10px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.union-selector button:hover {
    background: #0056b3;
}
.panel-header {
    text-align: center;
    margin-bottom: 40px;
    padding: 20px;
}
.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
}
.logo-left, .logo-right {
    flex: 0 0 auto;
}
.logo-left img, .logo-right img {
    height: 100px;
    object-fit: contain;
}
.header-text {
    flex: 1;
    padding: 0 20px;
    text-align: center;
}
.govt-title {
    font-size: 24px;
    font-weight: bold;
    color: #000;
    margin: 0 0 8px 0;
}
.union-title-green {
    font-size: 30px;
    font-weight: 800;
    color: #006600;
    margin: 0 0 8px 0;
}
.union-title-blue {
    font-size: 28px;
    font-weight: 700;
    color: #003366;
    margin: 0;
}
/* Cards Grid - 3 per row */
.panel-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 30px 25px;
    max-width: 1400px;
    margin: 0 auto;
    justify-content: center;
    align-items: stretch;
}
/* Make all cards fill the grid cell height and set width for 3 per row */
.panel-grid .member-card {
    height: 100%;
    flex-shrink: 0;
    width: calc((100% - 50px) / 3); /* 3 columns with 25px gap */
}
/* Section title */
.section-title {
    width: 100%;
    text-align: center;
    margin: 24px 0 24px 0;
    font-size: 26px;
    font-weight: 800;
    color: #006600;
    text-transform: uppercase;
    letter-spacing: 2px;
    border-bottom: 3px solid #006600;
    padding-bottom: 12px;
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

/* All cards have consistent max width for 3 per row */
.chairman-card,
.panel-chairman-card,
.regular-member-card,
.reserve-member-card {
    max-width: 320px;
}
.member-card:hover { transform: translateY(-5px); }
.card-photo-bg {
    height: 240px;
    width: 100%;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: flex-end;
    justify-content: center;
}
.card-info {
    background: white;
    padding: 15px 12px;
    text-align: center;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 100%;
}
.bg-green  { background: linear-gradient(to bottom, #a3e635, #65a30d); }
.bg-blue   { background: linear-gradient(to bottom, #38bdf8, #0284c7); }
.bg-purple { background: linear-gradient(to bottom, #c084fc, #9333ea); }
.bg-pink   { background: linear-gradient(to bottom, #f472b6, #db2777); }
.bg-orange { background: linear-gradient(to bottom, #fb923c, #ea580c); }
.bg-teal   { background: linear-gradient(to bottom, #2dd4bf, #0f766e); }
.bg-gray   { background: linear-gradient(to bottom, #9ca3af, #4b5563); }
.card-photo-bg img {
    height: 100%;
    width: 100%;
    object-fit: cover;
    object-position: top center;
    z-index: 2;
}
.card-info {
    background: white;
    padding: 15px 12px;
    text-align: center;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.member-name {
    font-size: 12px;
    font-weight: 800;
    color: #e11d48;
    text-transform: uppercase;
    margin: 0 0 4px 0;
    line-height: 1.4;
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
}
.member-desig {
    font-size: 13px;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
    line-height: 1.4;
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
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

  <!-- Union Selector (Super Admin Only) -->
  @if($isSuperAdmin)
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="union-selector">
            <form method="GET" action="{{ route('chairman.panelList') }}" id="unionSelectorForm">
              <label for="union_id">Select Union:</label>
              <select name="union_id" id="union_id" class="form-control select2" style="width: 400px;">
                <option value="">-- Select Union --</option>
                @foreach($unions as $union)
                  <option value="{{ $union->id }}" {{ $selectedUnionId == $union->id ? 'selected' : '' }}>
                    {{ $union->name }} ({{ $union->Thana->name ?? '' }}, {{ $union->Thana->District->name ?? '' }})
                  </option>
                @endforeach
              </select>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          @if(!$isSuperAdmin || ($isSuperAdmin && $selectedUnionId))
          @php $bgColors = ['bg-blue','bg-purple','bg-pink','bg-orange','bg-teal','bg-gray']; @endphp
          @php $noImg = asset('public/no-image-found.jpeg'); @endphp

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
              $institute = $first_council ? ($institutes[$first_council->union_id] ?? null) : null;
              if ($institute && $institute->left_image) {
                  $logoUrl = imageUrl($institute->left_image);
              } elseif ($institute && $institute->top_image) {
                  $logoUrl = imageUrl($institute->top_image);
              } else {
                  $logoUrl = asset('assets/images/logo/govt-bd-logo.png');
              }
          @endphp

          <div class="panel-container mb-5">

            <!-- Header: Dynamic Union Info -->
            <div class="panel-header">
              <div class="header-content">
                <!-- Left Logo -->
                <div class="logo-left">
                  @if ($institute && $institute->left_image)
                    <img src="{{ imageUrl($institute->left_image) }}" alt="Left Logo" onerror="this.onerror=null;this.src='{{ asset('assets/images/logo/govt-bd-logo.png') }}'">
                  @else
                    <img src="{{ asset('assets/images/logo/govt-bd-logo.png') }}" alt="Left Logo">
                  @endif
                </div>

                <!-- Header Text -->
                <div class="header-text">
                  <p class="govt-title">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
                  @if($first_council && $first_council->union)
                    <p class="union-title-green">{{ $first_council->union->bn_name ?? $first_council->union->name ?? 'Union Parishad' }}</p>
                    <p class="union-title-blue">{{ $first_council->union->name ?? '' }}</p>
                  @endif
                </div>

                <!-- Right Logo -->
                <div class="logo-right">
                  @if ($institute && $institute->right_image)
                    <img src="{{ imageUrl($institute->right_image) }}" alt="Right Logo" onerror="this.onerror=null;this.src='{{ asset('assets/images/logo/govt-bd-logo.png') }}'">
                  @else
                    <img src="{{ asset('assets/images/logo/govt-bd-logo.png') }}" alt="Right Logo">
                  @endif
                </div>
              </div>
            </div>

            <!-- Segment 1: Chairman Section -->
            <div class="panel-grid mb-5">
              <div class="section-title">CHAIRMAN</div>
              @if($all_chairmen->count() > 0)
              @foreach($all_chairmen as $chairman)
              <div class="member-card chairman-card">
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
            </div>

            <!-- Segment 2: Regular Members Section -->
            <div class="panel-grid mb-5">
              <div class="section-title">REGULAR MEMBERS</div>
              @if($all_regular_members->count() > 0)
              @foreach($all_regular_members as $index => $rm)
              <div class="member-card regular-member-card">
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
            </div>

            <!-- Segment 3: Reserve Members Section -->
            <div class="panel-grid mb-5">
              <div class="section-title">RESERVE MEMBERS</div>
              @if($all_reserve_members->count() > 0)
              @foreach($all_reserve_members as $index => $rwm)
              <div class="member-card reserve-member-card">
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
            </div>

            <!-- Segment 4: Panel Chairman Section -->
            <div class="panel-grid">
              <div class="section-title">PANEL CHAIRMAN</div>
              @if($all_panel_chairmen->count() > 0)
              @foreach($all_panel_chairmen as $panel_chairman)
              <div class="member-card panel-chairman-card">
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
            </div>
          </div><!-- /.panel-container -->
          @else
          <div class="card">
            <div class="card-body text-center py-5">
              <h4 class="text-muted">Please select a union from the dropdown above to view the panel</h4>
            </div>
          </div>
          @endif

        </div>
      </div>
    </div>
  </section>
@endsection
@push('script')
<script type="text/javascript">
  $(document).ready(function() {
    // Initialize Select2
    $('#union_id').select2({
      theme: 'bootstrap4',
      placeholder: '-- Select Union --',
      allowClear: true
    });

    // Handle select change
    $('#union_id').on('change', function() {
      $('#unionSelectorForm').submit();
    });
  });
</script>
@endpush
