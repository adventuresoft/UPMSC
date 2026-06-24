@extends('backend.master', ['mainMenu' => 'chairman', 'subMenu' =>'panelList'])
@push('style')
<style>
/* Smart & Professional Certificate Layout */
.certificate-frame {
    background: #ffffff;
    padding: 12px;
    position: relative;
    border: 1px solid #d4af37;
    box-shadow: 
        0 0 0 6px #ffffff,
        0 0 0 10px #006a4e,
        0 0 0 12px #d4af37,
        0 20px 40px rgba(0,0,0,0.15);
    margin: 30px 15px 40px 15px;
    border-radius: 2px;
    font-family: 'Inter', 'Source Sans Pro', sans-serif;
}

.certificate-inner {
    border: 2px solid #d4af37;
    padding: 40px 30px;
    position: relative;
    min-height: 70vh;
    background-color: #ffffff;
    z-index: 1;
}

.watermark-bg {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 450px;
    height: 450px;
    background-image: url('{{ asset("assets/images/logo/govt-bd-logo.png") }}');
    background-position: center;
    background-repeat: no-repeat;
    background-size: contain;
    opacity: 0.05;
    z-index: 0;
    pointer-events: none;
}

/* Thread-like fine striped grid pattern */
.pattern-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: -1;
    background-image: 
        repeating-linear-gradient(45deg, rgba(0, 106, 78, 0.035) 0px, rgba(0, 106, 78, 0.035) 1px, transparent 1px, transparent 15px),
        repeating-linear-gradient(-45deg, rgba(212, 175, 55, 0.035) 0px, rgba(212, 175, 55, 0.035) 1px, transparent 1px, transparent 15px);
}

.corner {
    position: absolute;
    width: 50px;
    height: 50px;
    border: 4px solid #d4af37;
    z-index: 0;
    pointer-events: none;
}
.corner-tl { top: 15px; left: 15px; border-right: none; border-bottom: none; }
.corner-tr { top: 15px; right: 15px; border-left: none; border-bottom: none; }
.corner-bl { bottom: 15px; left: 15px; border-right: none; border-top: none; }
.corner-br { bottom: 15px; right: 15px; border-left: none; border-top: none; }

.org-content {
    position: relative;
    z-index: 2;
}

.union-selector {
    background: #ffffff;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}
.union-selector select {
    padding: 8px 15px;
    border-radius: 4px;
    border: 1px solid #ced4da;
    min-width: 250px;
    display: inline-block;
}
.org-header {
    text-align: center;
    margin-bottom: 30px;
    border-bottom: 2px solid #e2e8f0;
    padding-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.org-logo img {
    height: 80px;
    object-fit: contain;
}
.org-header-text {
    flex-grow: 1;
}
.org-header-text .govt-text {
    margin: 0 0 5px 0;
    font-size: 16px;
    font-weight: 700;
    color: #333;
    letter-spacing: 1px;
}
.org-header-text h2 {
    color: #006a4e;
    font-weight: 800;
    margin: 0 0 6px 0;
    font-size: 28px;
    letter-spacing: 0.5px;
}
.org-header-text h3 {
    color: #d4af37;
    font-weight: 700;
    margin: 0;
    font-size: 20px;
}
.org-section {
    margin-bottom: 25px;
}
.org-section-title {
    text-align: center;
    font-size: 15px;
    font-weight: 800;
    color: #006a4e;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 18px;
    position: relative;
}
.org-section-title::after {
    content: '';
    display: block;
    width: 80px;
    height: 2px;
    background: #d4af37;
    margin: 8px auto 0;
}
.org-level {
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
}
/* Force exactly 3 cards per row */
.max-3-cols {
    max-width: 470px;
    margin: 0 auto;
}
/* Force exactly 1 card per row */
.max-1-col {
    max-width: 155px;
    margin: 0 auto;
}
/* Combined Grid for perfectly aligned rows */
.members-combined-grid {
    display: grid;
    grid-template-columns: repeat(3, 140px) 40px 140px;
    gap: 15px 15px;
    justify-content: center;
    margin-bottom: 25px;
}
.grid-header-reg {
    grid-column: 1 / 4;
    white-space: nowrap;
}
.grid-header-res {
    grid-column: 5 / 6;
    white-space: nowrap;
}
.grid-spacer {
    grid-column: 4 / 5;
    position: relative;
    display: flex;
    justify-content: center;
}
.grid-horizontal-divider {
    grid-column: 1 / -1;
    height: 2px;
    background: rgba(0, 106, 78, 0.4); /* Green color */
}
.grid-spacer-line {
    position: absolute;
    top: -32px; /* Bridges the row gaps + divider */
    bottom: 0;
    width: 2px;
    background: rgba(0, 106, 78, 0.4); /* Green color */
}
.line-first {
    top: -15px; /* Only bridges the gap to the header */
    background: linear-gradient(to bottom, transparent, rgba(0, 106, 78, 0.4) 30px, rgba(0, 106, 78, 0.4));
}
.line-last {
    bottom: 10px;
    background: linear-gradient(to top, transparent, rgba(0, 106, 78, 0.4) 30px, rgba(0, 106, 78, 0.4));
}
.line-first-last {
    top: -15px;
    bottom: 10px;
    background: linear-gradient(to bottom, transparent, rgba(0, 106, 78, 0.4) 30px, rgba(0, 106, 78, 0.4) calc(100% - 30px), transparent);
}
.member-card {
    background: rgba(255, 255, 255, 0.95);
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 12px;
    width: 140px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0,0,0,0.04);
    transition: all 0.3s ease;
    position: relative;
}
.member-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    border-color: #cbd5e1;
}
/* Passport size photo container (approx 4:5 ratio) */
.photo-container {
    width: 90px;
    height: 112px;
    margin: 0 auto 10px auto;
    border: 2px solid #e2e8f0;
    border-radius: 4px;
    overflow: hidden;
    background: #f1f5f9;
}
.photo-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
}
.member-name {
    font-size: 12px;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 5px 0;
    line-height: 1.3;
    word-wrap: break-word;
}
.member-desig {
    font-size: 11px;
    font-weight: 700;
    color: #006a4e;
    margin: 0;
    line-height: 1.2;
    background: #f1f5f9;
    padding: 4px 6px;
    border-radius: 4px;
    display: inline-block;
}
/* Specific tweaks for different roles */
.chairman-card {
    width: 160px;
    border: 2px solid #006a4e;
    box-shadow: 0 6px 12px rgba(0, 106, 78, 0.1);
}
.chairman-card .photo-container {
    width: 100px;
    height: 125px;
    border-color: #006a4e;
}
.chairman-card .member-desig {
    background: #006a4e;
    color: #ffffff;
}
.panel-chairman-card {
    border: 1px solid #d4af37;
}
.panel-chairman-card .photo-container {
    border-color: #d4af37;
}
.panel-chairman-card .member-desig {
    background: #fef08a;
    color: #854d0e;
}

/* Print Styles for A4 Page */
@media print {
    @page {
        size: A4 portrait;
        margin: 5mm;
    }
    body, html {
        background: #fff !important;
        margin: 0 !important;
        padding: 0 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    /* Hide layout elements */
    .main-header, .main-sidebar, .content-header, .main-footer, .union-selector, .breadcrumb {
        display: none !important;
    }
    .content-wrapper {
        margin-left: 0 !important;
        padding: 0 !important;
        background: #fff !important;
    }
    .certificate-frame {
        margin: 25px !important;
        page-break-inside: avoid;
        box-shadow: none !important; /* Printers strip box-shadow */
    }
    /* Recreate the multi-layer border using real borders for print */
    .certificate-frame::after {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        border: 4px solid #006a4e !important;
        outline: 2px solid #d4af37 !important;
        pointer-events: none;
        z-index: 10;
    }
    .certificate-inner {
        padding: 20px 15px !important;
    }
    .org-header {
        margin-bottom: 15px !important;
        padding-bottom: 10px !important;
    }
    .org-logo img {
        height: 60px !important;
    }
    .org-header-text h2 {
        font-size: 20px !important;
        margin: 0 0 2px 0 !important;
    }
    .org-header-text h3 {
        font-size: 16px !important;
    }
    .org-section {
        margin-bottom: 10px !important;
    }
    .members-combined-grid {
        grid-template-columns: repeat(3, 120px) 20px 120px !important;
        gap: 8px 8px !important;
        margin-bottom: 10px !important;
    }
    .grid-spacer-line { top: -18px !important; }
    .line-first { top: -8px !important; }
    .line-last { bottom: 5px !important; }
    .line-first-last { top: -8px !important; bottom: 5px !important; }
    .org-section-title {
        font-size: 12px !important;
        margin-bottom: 8px !important;
    }
    .org-section-title::after {
        margin: 4px auto 0 !important;
    }
    .org-level {
        gap: 8px !important;
    }
    .member-card {
        padding: 8px !important;
        width: 120px !important;
    }
    .photo-container {
        width: 75px !important;
        height: 94px !important;
        margin-bottom: 6px !important;
    }
    .member-name {
        font-size: 10px !important;
        margin-bottom: 2px !important;
    }
    .member-desig {
        font-size: 9px !important;
        padding: 2px 4px !important;
    }
    .chairman-card {
        width: 135px !important;
    }
    .chairman-card .photo-container {
        width: 85px !important;
        height: 106px !important;
    }
}
</style>
@endpush

@section('title', 'Panel Hierarchy')
@section('content')
  <!-- Content Header -->
  <section class="content-header pb-1">
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
            <form method="GET" action="{{ route('chairman.panelList') }}" id="unionSelectorForm" class="form-inline justify-content-center">
              <label for="union_id" class="mr-2 font-weight-bold">Select Union:</label>
              <select name="union_id" id="union_id" class="form-control select2 mr-2" style="width: 300px;">
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
          @php 
              $noImg = asset('default.png'); 
              
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

              $first_council = $councils->first();
              $institute = $first_council ? ($institutes[$first_council->union_id] ?? null) : null;
              
              $eng = ['0','1','2','3','4','5','6','7','8','9'];
              $bng = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
              $startYear = $first_council && $first_council->start_date ? date('Y', strtotime($first_council->start_date)) : '';
              $endYear = $first_council && $first_council->end_date ? date('Y', strtotime($first_council->end_date)) : '';
              $startYearBn = str_replace($eng, $bng, $startYear);
              $endYearBn = str_replace($eng, $bng, $endYear);
              
              $panelTitle = "প্যানেল তালিকা";
              if($startYearBn && $endYearBn) {
                  $panelTitle = "পরিষদ {$startYearBn}–{$endYearBn} প্যানেল";
              }
          @endphp

          <div class="certificate-frame">
            <div class="certificate-inner">
              <div class="pattern-overlay"></div>
              <div class="watermark-bg"></div>
              <div class="corner corner-tl"></div>
              <div class="corner corner-tr"></div>
              <div class="corner corner-bl"></div>
              <div class="corner corner-br"></div>
              
              <div class="org-content">
                <!-- Header: Dynamic Union Info -->
                <div class="row align-items-center mb-4" style="border-bottom: 2px solid #e2e8f0; padding-bottom: 20px;">
                    <div class="col-2 text-center">
                        @if ($institute && $institute->left_image)
                          <img height="90" width="90" src="{{ imageUrl($institute->left_image) }}" alt="Left Logo" onerror="this.onerror=null;this.src='{{ asset('images/dhaka.png') }}'">
                        @else
                          <img height="90" width="90" src="{{ asset('images/dhaka.png') }}" alt="Left Logo" onerror="this.onerror=null;this.src='{{ asset('assets/images/logo/govt-bd-logo.png') }}'">
                        @endif
                    </div>

                    <div class="col-8 text-center">
                        <h2 class="text- font-Nikosh-bold mb-0" style="font-size:18px; position: relative; top: -10px;">
                            গণপ্রজাতন্ত্রী বাংলাদেশ সরকার
                        </h2>
                        <div class="text-center">
                            @if($first_council && $first_council->union)
                                <h2 class="dynamic-bn-name text-success font-weight-bold mb-0" style="width: max-content; margin: 0 auto; font-family: 'Kalpurush-Bold', sans-serif; font-size:26px; line-height: 1.3; white-space: nowrap;">
                                    {{ $first_council->union->bn_name ?? $first_council->union->name ?? '' }}
                                </h2>
                                <h2 class="dynamic-en-name font-weight-bold mb-0" style="width: max-content; margin: 0 auto; color:#2e3192; font-size:22px; text-transform: uppercase; line-height: 1.3; white-space: nowrap;">
                                    {{ $first_council->union->name ?? '' }}
                                </h2>
                                <p class="mb-0 mt-1" style="font-size:15px; ">
                                    উপজেলাঃ {{ $first_council->union->thana->bn_name ?? '' }},
                                    জেলাঃ {{ $first_council->union->thana->district->bn_name ?? '' }},
                                    বাংলাদেশ।
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="col-2 text-center">
                        @if ($institute && $institute->right_image)
                          <img height="90" width="90" src="{{ imageUrl($institute->right_image) }}" alt="Right Logo" onerror="this.onerror=null;this.src='{{ asset('images/govt-bd-logo.png') }}'">
                        @else
                          <img height="90" width="90" src="{{ asset('images/govt-bd-logo.png') }}" alt="Right Logo" onerror="this.onerror=null;this.src='{{ asset('assets/images/logo/govt-bd-logo.png') }}'">
                        @endif
                    </div>
                </div>

                <div class="row mb-4 align-items-center">
                    <div class="col-12 text-center">
                        <span class="badge text-light px-4 py-2"
                              style="font-size: clamp(14px, 1.5vw, 22px); border-radius:28px; background-color: #2F318C;">
                            {{ $panelTitle }}
                        </span>
                    </div>
                </div>

                <!-- Segment 1: Chairman Section -->
                @if($all_chairmen->count() > 0)
                <div class="org-section">
                  <div class="org-section-title">Chairman</div>
                  <div class="org-level">
                    @foreach($all_chairmen as $chairman)
                    <div class="member-card chairman-card">
                      <div class="photo-container">
                        <img src="{{ $chairman->user->image ? imageUrl($chairman->user->image) : $noImg }}"
                             alt="Chairman" onerror="this.onerror=null;this.src='{{ $noImg }}'">
                      </div>
                      <p class="member-name">{{ $chairman->user->name ?? 'N/A' }}</p>
                      <p class="member-desig">Chairman / Mayor</p>
                    </div>
                    @endforeach
                  </div>
                </div>
                @endif

                <!-- Combined Segment: Regular and Reserve Members -->
                @if($all_regular_members->count() > 0 || $all_reserve_members->count() > 0)
                <div class="members-combined-grid">
                    <!-- Headers -->
                    <div class="org-section-title grid-header-reg" style="margin-bottom:0;">General Members</div>
                    <div class="grid-spacer"></div>
                    <div class="org-section-title grid-header-res" style="margin-bottom:0;">Reserve Members</div>
                    
                    @php
                        $maxRows = max(ceil($all_regular_members->count() / 3), $all_reserve_members->count());
                    @endphp

                    <!-- Grid Rows -->
                    @for($i = 0; $i < $maxRows; $i++)
                        @php
                            $isFirst = ($i == 0);
                            $isLast = ($i == $maxRows - 1);
                            $lineClass = '';
                            if($isFirst && $isLast) $lineClass = 'line-first-last';
                            elseif($isFirst) $lineClass = 'line-first';
                            elseif($isLast) $lineClass = 'line-last';
                        @endphp

                        <!-- 3 Regular Members -->
                        @for($j = 0; $j < 3; $j++)
                            @php $rm = $all_regular_members->get($i * 3 + $j); @endphp
                            @if($rm)
                            <div class="member-card">
                              <div class="photo-container">
                                <img src="{{ $rm->user->image ? imageUrl($rm->user->image) : $noImg }}"
                                     alt="Member" onerror="this.onerror=null;this.src='{{ $noImg }}'">
                              </div>
                              <p class="member-name">{{ $rm->user->name ?? 'N/A' }}</p>
                              <p class="member-desig">{{ $rm->word_no_text ?: 'Member' }}</p>
                            </div>
                            @else
                            <div></div> <!-- Empty placeholder -->
                            @endif
                        @endfor

                        <div class="grid-spacer">
                            <div class="grid-spacer-line {{ $lineClass }}"></div>
                        </div>

                        <!-- 1 Reserve Member -->
                        @php $rwm = $all_reserve_members->get($i); @endphp
                        @if($rwm)
                        <div class="member-card">
                          <div class="photo-container">
                            <img src="{{ $rwm->user->image ? imageUrl($rwm->user->image) : $noImg }}"
                                 alt="Reserve Member" onerror="this.onerror=null;this.src='{{ $noImg }}'">
                          </div>
                          <p class="member-name">{{ $rwm->user->name ?? 'N/A' }}</p>
                          <p class="member-desig">{{ $rwm->word_no_text ?: 'Reserve Member' }}</p>
                        </div>
                        @else
                        <div></div> <!-- Empty placeholder -->
                        @endif

                        <!-- Horizontal Divider Line -->
                        @if(!$isLast)
                            <div class="grid-horizontal-divider"></div>
                        @endif
                    @endfor
                </div>
                @endif

                <!-- Segment 4: Panel Chairman Section -->
                @if($all_panel_chairmen->count() > 0)
                <div class="org-section">
                  <div class="org-section-title">Panel Chairman</div>
                  <div class="org-level">
                    @foreach($all_panel_chairmen as $panel_chairman)
                    <div class="member-card panel-chairman-card">
                      <div class="photo-container">
                        <img src="{{ $panel_chairman->user->image ? imageUrl($panel_chairman->user->image) : $noImg }}"
                             alt="Panel Chairman" onerror="this.onerror=null;this.src='{{ $noImg }}'">
                      </div>
                      <p class="member-name">{{ $panel_chairman->user->name ?? 'N/A' }}</p>
                      <p class="member-desig">Panel Chairman</p>
                    </div>
                    @endforeach
                  </div>
                </div>
                @endif
              </div><!-- /.org-content -->

            </div><!-- /.certificate-inner -->
          </div><!-- /.certificate-frame -->

          @else
          <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">
              <i class="fas fa-sitemap fa-3x text-muted mb-3"></i>
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
    if($.fn.select2) {
      $('#union_id').select2({
        theme: 'bootstrap4',
        placeholder: '-- Select Union --',
        allowClear: true
      });
    }

    // Handle select change
    $('#union_id').on('change', function() {
      if($(this).val()) {
        $('#unionSelectorForm').submit();
      }
    });
  });
</script>
@endpush
