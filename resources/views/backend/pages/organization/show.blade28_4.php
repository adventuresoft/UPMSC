@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' =>'OrganizationShow'])

@section('title', 'Organization View')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Organization Details</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{route('organization.index')}}">Organization</a>
                    </li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
<div class="container-fluid">

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            Organization Information
        </h3>
    </div>

    <div class="card-body">

        {{-- Name --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Name:</div>
            <div class="col-sm-9">{{ $organization->name }}</div>
        </div>

        {{-- Bangla Name --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Name (Bangla):</div>
            <div class="col-sm-9">{{ $organization->bn_name }}</div>
        </div>

        {{-- Category --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Category:</div>
            <div class="col-sm-9">{{ $organization->category->en_name ?? '' }}</div>
        </div>

        {{-- Subcategory --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Sub Category:</div>
            <div class="col-sm-9">{{ $organization->subcategory->en_name ?? '' }}</div>
        </div>

        {{-- Type --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Type:</div>
            <div class="col-sm-9">{{ $organization->type->en_name ?? '' }}</div>
        </div>

        {{-- RJSC --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">RJSC:</div>
            <div class="col-sm-9">{{ $organization->rjsc_reg_no }}</div>
        </div>

        {{-- Division --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Division:</div>
            <div class="col-sm-9">{{ $organization->Division->name ?? '' }}</div>
        </div>

        {{-- District --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">District:</div>
            <div class="col-sm-9">{{ $organization->District->name ?? '' }}</div>
        </div>

        {{-- Thana --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Thana:</div>
            <div class="col-sm-9">{{ $organization->Thana->name ?? '' }}</div>
        </div>

        {{-- Union --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Union:</div>
            <div class="col-sm-9">{{ $organization->Union->name ?? '' }}</div>
        </div>

        {{-- Village --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Village:</div>
            <div class="col-sm-9">{{ $organization->Village->bn_name ?? '' }}</div>
        </div>

        {{-- Road --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Road:</div>
            <div class="col-sm-9">{{ $organization->road }}</div>
        </div>

        {{-- House --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">House:</div>
            <div class="col-sm-9">{{ $organization->house }}</div>
        </div>

        {{-- Capital --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Capital:</div>
            <div class="col-sm-9">{{ $organization->capital }}</div>
        </div>

        {{-- Status --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Status:</div>
            <div class="col-sm-9">
                @if($organization->status == 1)
                    <span class="badge badge-success">Approved</span>
                @else
                    <span class="badge badge-warning">Pending</span>
                @endif
            </div>
        </div>

    </div>

    <div class="card-footer">

        <a href="{{route('organization.index')}}" class="btn btn-secondary">
            Back
        </a>

        @if($organization->status != 1)
        <button class="btn btn-success float-right" id="approveBtn">
            ✔ Approve
        </button>
        @endif

    </div>

</div>


<!-- ================= ORGANIZATION OWNERS ================= -->
<div class="card card-primary mt-3">
    <div class="card-header">
        <h3 class="card-title">Organization Owners</h3>
    </div>

    <div class="card-body">
        <div class="row">

            @forelse($organization->ownership ?? [] as $owner)

@php
    $user = $owner->user;
    $people = $owner->user->people;
    $addr = $user->addressInfo ?? null;
    $family = $user->familyInfo ?? null;
@endphp

<div class="col-md-6">
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">

            {{-- HEADER --}}
            <div class="d-flex align-items-center mb-3">
                <img 
                    src="{{ $user->image ?? asset('no-image-found.jpeg') }}"
                    class="rounded-circle border mr-3"
                    width="60" height="60"
                    style="object-fit:cover;"
                >
                <div>
                    <h5 class="mb-0">{{ $user->name ?? 'Demo Name' }}</h5>
                    <small class="text-muted">{{ $owner->designation ?? 'Owner' }}</small>
                </div>
            </div>

            {{-- BASIC INFO --}}
            <div class="row mb-1">
                <div class="col-5 font-weight-bold">Name (BN):</div>
                <div class="col-7">{{ $people->bn_name ?? 'ডেমো নাম' }}</div>
            </div>

            <div class="row mb-1">
                <div class="col-5 font-weight-bold">Father (EN):</div>
                <div class="col-7">{{ $family->father_name ?? 'Demo Father' }}</div>
            </div>

            <div class="row mb-1">
                <div class="col-5 font-weight-bold">Father (BN):</div>
                <div class="col-7">{{ $family->father_name_bn ?? 'ডেমো বাবা' }}</div>
            </div>

            <div class="row mb-1">
                <div class="col-5 font-weight-bold">Mother (EN):</div>
                <div class="col-7">{{ $family->mother_name ?? 'Demo Mother' }}</div>
            </div>

            <div class="row mb-1">
                <div class="col-5 font-weight-bold">Mother (BN):</div>
                <div class="col-7">{{ $family->mother_name_bn ?? 'ডেমো মা' }}</div>
            </div>

            {{-- PERSONAL --}}
            <div class="row mb-1">
                <div class="col-5 font-weight-bold">DOB:</div>
                <div class="col-7">{{ $user->date_of_birth ?? '2000-01-01' }}</div>
            </div>

            <div class="row mb-1">
                <div class="col-5 font-weight-bold">Birth Reg:</div>
                <div class="col-7">{{ $user->birth_certificate ?? '1234567890' }}</div>
            </div>

            <div class="row mb-1">
                <div class="col-5 font-weight-bold">NID:</div>
                <div class="col-7">{{ $user->nid ?? '0000000000000' }}</div>
            </div>

            <div class="row mb-1">
                <div class="col-5 font-weight-bold">Gender:</div>
                <div class="col-7">{{ $user->gender ?? 'Male' }}</div>
            </div>

            <div class="row mb-1">
                <div class="col-5 font-weight-bold">Religion:</div>
                <div class="col-7">{{ $user->religion->name ?? 'Islam' }}</div>
            </div>

            <div class="row mb-1">
                <div class="col-5 font-weight-bold">Blood Group:</div>
                <div class="col-7">{{ $user->blood_group ?? 'O+' }}</div>
            </div>

            {{-- CONTACT --}}
            <div class="row mb-1">
                <div class="col-5 font-weight-bold">Mobile:</div>
                <div class="col-7">{{ $user->mobile ?? '01XXXXXXXXX' }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-5 font-weight-bold">Email:</div>
                <div class="col-7">{{ $user->email ?? 'demo@email.com' }}</div>
            </div>

            {{-- PRESENT ADDRESS FULL --}}
            <div class="row mb-2">
                <div class="col-5 font-weight-bold">Present Address:</div>
                <div class="col-7">
                    {{
                        collect([
                            $addr->presentDivision->name ?? 'Demo Division',
                            $addr->presentDistrict->name ?? 'Demo District',
                            $addr->presentThana->name ?? 'Demo Thana',
                            $addr->presentPostoffice->name ?? 'Demo PO',
                            $addr->presentUnion->name ?? 'Demo Union',
                            $addr->presentVillage->en_name ?? 'Demo Village',
                            $addr->present_ward_id ?? 'Ward 1',
                            $addr->present_road ?? 'Road 10',
                            $addr->present_house ?? 'House 20',
                            $addr->present_house_bn ?? 'বাড়ি'
                        ])->filter()->implode(', ')
                    }}
                </div>
            </div>

            {{-- PERMANENT ADDRESS FULL --}}
            <div class="row">
                <div class="col-5 font-weight-bold">Permanent Address:</div>
                <div class="col-7">
                    {{
                        collect([
                            $addr->permanentDivision->name ?? 'Demo Division',
                            $addr->permanentDistrict->name ?? 'Demo District',
                            $addr->permanentThana->name ?? 'Demo Thana',
                            $addr->permanentPostoffice->name ?? 'Demo PO',
                            $addr->permanentUnion->name ?? 'Demo Union',
                            $addr->permanentVillage->en_name ?? 'Demo Village',
                            $addr->permanent_ward_id ?? 'Ward 2',
                            $addr->permanent_road ?? 'Road 5',
                            $addr->permanent_house ?? 'House 50',
                            $addr->permanent_house_bn ?? 'স্থায়ী বাড়ি'
                        ])->filter()->implode(', ')
                    }}
                </div>
            </div>

        </div>
    </div>
</div>

@empty

{{-- FULL DEMO CARD --}}
<div class="col-md-6">
    <div class="card shadow-sm border-0 text-center p-3">

        <img src="{{ asset('no-image-found.jpeg') }}" width="60" class="rounded-circle mb-2">

        <h5>Demo Owner</h5>
        <small class="text-muted">Owner</small>

        <hr>

        <p><strong>Name BN:</strong> ডেমো নাম</p>
        <p><strong>Father:</strong> Demo Father</p>
        <p><strong>Mother:</strong> Demo Mother</p>
        <p><strong>DOB:</strong> 2000-01-01</p>
        <p><strong>NID:</strong> 0000000000000</p>
        <p><strong>Mobile:</strong> 01XXXXXXXXX</p>
        <p><strong>Email:</strong> demo@email.com</p>

        <p><strong>Address:</strong><br>
            Demo Village, Demo Area, Road 1, House 10
        </p>

    </div>
</div>

@endforelse

        </div>
    </div>
</div>

</div>
</section>

@endsection

@push('script')

<script>
$('#approveBtn').click(function(){

    if(confirm("Are you sure you want to approve this organization?")){

        $.ajax({
            url: "{{ route('organization.approve') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: "{{ $organization->id }}"
            },
            success: function(response){
                alert("Approved Successfully");
                location.reload();
            },
            error: function(){
                alert("Something went wrong");
            }
        });

    }

});
</script>

@endpush