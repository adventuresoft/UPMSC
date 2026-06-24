@php
    // Helper to check if any of the given routes are active
    $isRoute = function($routes) {
        foreach ((array)$routes as $route) {
            if (request()->routeIs($route)) return true;
        }
        return false;
    };

    // Helper to check if any of the given patterns are active
    $isPath = function($patterns) {
        foreach ((array)$patterns as $pattern) {
            if (request()->is($pattern)) return true;
        }
        return false;
    };

    // Fallback for variables that might not be passed from controller
    $_subMenu = $subMenu ?? null;
    $_mainMenu = $mainMenu ?? null;

    // Define active states for major sections
    $isBasicSettings = $isPath(['basic-settings*', '*/basic-settings*']) || in_array($_subMenu, ['CityCorporation', 'CityCorporationWard', 'FamilyCategory', 'FamilySubcategory', 'FamilyType', 'Financialyear', 'HouseType', 'HouseCategory', 'HouseClass', 'HouseOwnershipType', 'LandType', 'LandClass', 'LandOwnershipType', 'MarketType', 'MarketCategory', 'MarketOwnershipType', 'OrganizationCategory', 'OrganizationSubcategory', 'OrganizationWorkArea', 'OrganizationOwnershipType', 'OrganizationType', 'OrganizationSubtype', 'OrganizationClass', 'Profession', 'ProfessionCategory', 'ProfessionSubcategory', 'ProfessionType', 'RoadCategory', 'RoadType', 'RoadOwner', 'ResarvWard', 'VehicleCategory', 'VehicleSubcategory', 'VehicleType', 'UnionWard', 'ReserveWard', 'Village', 'VillageArea', 'Union', 'PostOffice', 'Country', 'Year']);
    
    $isAccessManagement = $isRoute(['role.*', 'permission.*', 'user.*']) || (isset($page) && in_array($page, ['role', 'permission', 'rolepermission', 'userper', 'roleuser', 'user']));
    
    $isInstituteSettings = $isPath(['institute*']) || in_array($_subMenu, ['InstituteCreate', 'InstituteType', 'InstituteCategory', 'InstituteList']);
    
    $isPeopleInfo = $isPath(['people*', 'peopleapprovedlist*', 'peoplesearch*']) || in_array($_subMenu, ['Create', 'View', 'Show', 'approvedList', 'search']);
    
    $isCertificate = $isPath(['citizen*', 'character*', 'death*', 'succession*', 'unmarried*', 'married*', 'remarried*', 'landless*', 'name*', 'income*', 'disability-certificate*', 'voter-area*', 'voter-list*', 'nid-correction*', 'childless*', 'orphan*', 'financial-instability*', 'age*', 'permanent-citizen*', 'residential*', 'guardian-income*', 'guardian-acceptance*', /* <!-- ADDED CERTS SLUGS --> */ 'birth-registration-correction*', 'new-voter-recommendation*', 'voter-registration-agreement*', 'not-rohingya*', 'passport-related*', 'family*', 'alive*', 'missing-person*', 'abandoned-by-husband*', 'widow*', 'dependency*', 'dowryless*', 'unemployment*', 'helplessness*', 'illiteracy*', 'agriculture*', 'fisherman*', 'professional*', 'farmer-fuel-oil-card*', 'no-objection*', 'general*', 'infrastructure-construction-permission*', 'power-of-attorney*', 'ethnic-minority*', 'tribal*', 'indigenous*']) || $_mainMenu == 'Certificate';
    
    $isOrganization = $isPath(['organization*', 'orgapproved*']) || in_array($_subMenu, ['OrganizationCreate', 'OrganizationList', 'ApprovedOrganizationList', 'OrganizationShow', 'RegistrationFees', 'RenewFees', 'TradeLicense', 'GetTradeLicense', 'OrganizationTransferRequest', 'IncomingTransferRequest']);
    
    $isTax = $isPath(['tax*', 'taxes*']) || in_array($_subMenu, ['TaxGenerate', 'TaxReceived', 'TaxRateList', 'TaxList']);
    
    $isHouse = $isPath(['house*']) || in_array($_subMenu, ['HouseCreate', 'HouseList']);
    
    $isLand = $isPath(['land*']) || in_array($_subMenu, ['LandCreate', 'LandList']);
    
    $isVehicle = $isPath(['vehicle*']) || in_array($_subMenu, ['VehicleCreate', 'VehicleList', 'VehicleApprovalList', 'VehicleGenerateInvoice', 'VehicleLicense', 'VehicleAddFeesNewSetup', 'VehicleAddFeesList']);
    
    $isRoad = $isPath(['road*']) || in_array($_subMenu, ['RoadCreate', 'RoadList']);

    $isWedding = $isPath(['marriage*', 'divorce*']) || in_array($_subMenu, ['MarriageCreate', 'MarriageList', 'DivorceCreate', 'DivorceList']) || in_array($_mainMenu, ['Marriage', 'Divorce']);

    $isChairman = $isPath(['chairman*']) || in_array($_subMenu, ['chairmanCreate', 'chairmanList']) || $_mainMenu == 'chairman';

    $isCouncilor = $isPath(['councilor*']) || in_array($_subMenu, ['councilorCreate', 'councilorList']) || $_mainMenu == 'councilor';

    $isReliefCard = $isPath(['relief-card*']) || $_subMenu == 'ReliefCardList';
@endphp

<style>
  .nav-sidebar .nav-item {
    margin: 0px !important;
    padding: 0px !important;
  }
  .nav-sidebar .nav-link {
    padding-top: 2px !important;
    padding-bottom: 2px !important;
    line-height: 1.2 !important;
  }
  .nav-sidebar .nav-treeview > .nav-item > .nav-link {
    padding-top: 1px !important;
    padding-bottom: 1px !important;
  }
  .nav-sidebar .nav-treeview > .nav-item > .nav-link > .nav-icon {
    font-size: 10px !important;
  }
  .nav-sidebar p {
    margin-bottom: 0 !important;
  }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- Brand Logo -->
  @php
      $currentLogo = asset('backend/img/AdminLTELogo.png');
      $currentBrandText = 'CLMS';

      if (Auth::guard('web')->check() && Auth::guard('web')->user()->institute) {
          $inst = Auth::guard('web')->user()->institute;
          if ($inst->left_image) {
              $currentLogo = imageUrl($inst->left_image);
          }
      } elseif (Auth::guard('people')->check() && Auth::guard('people')->user()->institute) {
          $inst = Auth::guard('people')->user()->institute;
          if ($inst->left_image) {
              $currentLogo = imageUrl($inst->left_image);
          }
      }
  @endphp
  <a href="{{route('home')}}" class="brand-link">
    <img src="{{ $currentLogo }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{ $currentBrandText }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        @if(Auth::guard('people')->check())
        {{-- Citizen Specific Menus --}}
        <li class="nav-item">
          <a href="{{route('people.dashboard')}}" class="nav-link {{ request()->routeIs('people.dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Citizen Dashboard</p>
          </a>
        </li>
        <li class="nav-item {{ request()->routeIs('people.profile') || request()->routeIs('people.applications.registration.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-circle"></i>
            <p>
              My Profile
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('people.profile')}}" class="nav-link {{ request()->routeIs('people.profile') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>View Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('people.applications.registration.create') }}" class="nav-link {{ request()->routeIs('people.applications.registration.*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Update Profile</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{route('people.password.change')}}" class="nav-link {{ request()->routeIs('people.password.change') ? 'active' : '' }}">
            <i class="nav-icon fas fa-shield-alt"></i>
            <p>Account Security</p>
          </a>
        </li>
        <li class="nav-item {{ request()->is('people-portal/applications*') && !request()->routeIs('people.applications.registration.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              আবেদনসমূহ (Applications)
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('people.applications.index') }}" class="nav-link {{ request()->routeIs('people.applications.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon text-green-500"></i>
                <p class="font-bold">à¦†à¦¬à§‡à¦¦à¦¨à§‡à¦° à¦…à¦¬à¦¸à§à¦¥à¦¾</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('people.applications.certificate.create') }}" class="nav-link {{ request()->routeIs('people.applications.certificate.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>à¦¸à¦¨à¦¦à¦ªà¦¤à§à¦° à¦†à¦¬à§‡à¦¦à¦¨</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('people.applications.trade-license.create') }}" class="nav-link {{ request()->routeIs('people.applications.trade-license.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>à¦Ÿà§à¦°à§‡à¦¡ à¦²à¦¾à¦‡à¦¸à§‡à¦¨à§à¦¸ à¦†à¦¬à§‡à¦¦à¦¨</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('people.applications.vehicle.create') }}" class="nav-link {{ request()->routeIs('people.applications.vehicle.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>যানবাহন আবেদন</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('people.applications.tax.create') }}" class="nav-link {{ request()->routeIs('people.applications.tax.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>à¦¹à§‹à¦²à§à¦¡à¦¿à¦‚ à¦Ÿà§à¦¯à¦¾à¦•à§à¦¸ à¦†à¦¬à§‡à¦¦à¦¨</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('people.applications.grant.create') }}" class="nav-link {{ request()->routeIs('people.applications.grant.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>à¦…à¦¨à§à¦¦à¦¾à¦¨ à¦ªà§à¦°à¦¾à¦ªà§à¦¤à¦¿à¦° à¦†à¦¬à§‡à¦¦à¦¨</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('people.applications.relief-card.create') }}" class="nav-link {{ request()->routeIs('people.applications.relief-card.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>à¦°à¦¿à¦²à¦¿à¦« à¦•à¦¾à¦°à§à¦¡ à¦†à¦¬à§‡à¦¦à¦¨</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();" class="nav-link text-danger">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
          </a>
        </li>
        @else
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

        {{-- Dashboard --}}
        @if(is_institutional_admin() || Auth::user()->can('dashboard.read'))
        <li class="nav-item menu-open">
          <a href="{{route('dashboard')}}" class="nav-link  @if($subMenu == "dashboard") active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @endif

        @can('basic-settings.read')
        {{-- Basic Settings --}}
        <li class="nav-item {{ $isBasicSettings ? 'menu-open' : '' }}">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-tasks"></i>
          <p>
            Basic Settings
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

        @if(view_permission('city_corporation'))
         <li class="nav-item">
          <a href="{{route('basic-settings.city-corporation.index')}}" class="nav-link {{$subMenu == 'CityCorporation'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>City Corporation</p>
          </a>
        </li>
        @endif

        @if(view_permission('city_corporation_ward'))
        <li class="nav-item">
          <a href="{{route('basic-settings.city-corporation-ward.index')}}" class="nav-link {{$subMenu == 'CityCorporationWard'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>City Corporation Ward</p>
          </a>
        </li>
        @endif
        
        @if(view_permission('family_category'))
        <li class="nav-item">
          <a href="{{route('basic-settings.family-category.index')}}" class="nav-link {{$subMenu == 'FamilyCategory'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Family Category</p>
          </a>
        </li>
        @endif
        
        @if(view_permission('family_subcategory'))
        <li class="nav-item">
          <a href="{{route('basic-settings.family-subcategory.index')}}" class="nav-link {{$subMenu == 'FamilySubcategory'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Family Subcategory</p>
          </a>
        </li>
        @endif
        
        @if(view_permission('family_type'))
        <li class="nav-item">
          <a href="{{route('basic-settings.family-type.index')}}" class="nav-link {{$subMenu == 'FamilyType'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Family Type</p>
          </a>
        </li>
        @endif

        @if(view_permission('house_ownership_type'))
        <li class="nav-item">
          <a href="{{route('basic-settings.house-ownership-type.index')}}" class="nav-link {{$subMenu == 'HouseOwnershipType'?'active':''}} ">
            <i class="far fa-circle nav-icon"></i>
            <p>House Ownership Type</p>
          </a>
        </li>
        @endif

        @if(view_permission('house_type'))
        <li class="nav-item">
          <a href="{{route('basic-settings.house-type.index')}}" class="nav-link @if($subMenu == "HouseType") active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>House Type</p>
          </a>
        </li>
        @endif

        @if(view_permission('house_category'))
        <li class="nav-item">
          <a href="{{route('basic-settings.house-category.index')}}" class="nav-link  @if($subMenu == "HouseCategory") active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>House Category</p>
          </a>
        </li>
        @endif

        @if(view_permission('house_class'))
        <li class="nav-item">
          <a href="{{route('basic-settings.house-class.index')}}" class="nav-link  @if($subMenu == "HouseClass") active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>House Class</p>
          </a>
        </li>
        @endif

        @if(view_permission('land_type'))
        <li class="nav-item">
          <a href="{{route('basic-settings.land-type.index')}}" class="nav-link   @if($subMenu == "LandType") active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Land Type</p>
          </a>
        </li>
        @endif
        
        @if(view_permission('land_class'))
        <li class="nav-item">
          <a href="{{route('basic-settings.land-class.index')}}" class="nav-link  @if($subMenu == "LandClass") active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Land Class</p>
          </a>
        </li>
        @endif
        
        @if(view_permission('land_ownership_type'))
        <li class="nav-item">
          <a href="{{route('basic-settings.land-ownership-type.index')}}" class="nav-link  @if($subMenu == "LandOwnershipType") active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Land Ownership Type</p>
          </a>
        </li>
        @endif

        @if(view_permission('organization_category'))
        <li class="nav-item">
          <a href="{{route('basic-settings.organization-category.index')}}" class="nav-link  @if($subMenu == "OrganizationCategory") active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Organization Category</p>
          </a>
        </li>
        @endif

        @if(view_permission('organization_subcategory'))
        <li class="nav-item">
          <a href="{{route('basic-settings.organization-subcategory.index')}}" class="nav-link  @if($subMenu == "OrganizationSubcategory") active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Org. Subcategory</p>
          </a>
        </li>
        @endif

        @if(view_permission('organization_work_area'))
        <li class="nav-item">
          <a href="{{route('basic-settings.organization-work-area.index')}}" class="nav-link   @if($subMenu == "OrganizationWorkArea") active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Org. Work Area</p>
          </a>
        </li>
        @endif

        @if(view_permission('organization_type'))
        <li class="nav-item">
          <a href="{{route('basic-settings.organization-type.index')}}" class="nav-link {{$subMenu == 'CityCorporationWard'?'active':''}} @if($subMenu == "OrganizationType") active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Organization Type</p>
          </a>
        </li>
        @endif

        @if(view_permission('organization_subtype'))
        <li class="nav-item">
          <a href="{{route('basic-settings.organization-subtype.index')}}" class="nav-link {{$subMenu == 'OrganizationSubtype'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Organization Subtype</p>
          </a>
        </li>
        @endif

        @if(view_permission('organization_class'))
        <li class="nav-item">
          <a href="{{route('basic-settings.organization-class.index')}}" class="nav-link {{$subMenu == 'OrganizationClass'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Organization Class</p>
          </a>
        </li>
        @endif

        @if(view_permission('organization_ownership_type'))
        <li class="nav-item">
          <a href="{{route('basic-settings.organization-ownership-type.index')}}" class="nav-link {{$subMenu == 'CityCorporationWard'?'active':''}} @if($subMenu == "OrganizationOwnershipType") active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Org. Ownership Type</p>
          </a>
        </li>
        @endif

        @if(view_permission('post_office'))
        <li class="nav-item">
          <a href="{{route('basic-settings.post-office.index')}}" class="nav-link {{$subMenu =='PostOffice'? 'active':''}} ">
            <i class="far fa-circle nav-icon"></i>
            <p>Post Office</p>
          </a>
        </li>
        @endif

        @if(view_permission('profession'))
        <li class="nav-item">
          <a href="{{route('basic-settings.profession.index')}}" class="nav-link {{$subMenu == 'CityCorporationWard'?'active':''}} @if($subMenu == "Profession") active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Profession</p>
          </a>
        </li>
        @endif

        @if(view_permission('profession_type'))
        <li class="nav-item">
          <a href="{{route('basic-settings.profession-type.index')}}" class="nav-link {{$subMenu == 'ProfessionType'?'active':''}} ">
            <i class="far fa-circle nav-icon"></i>
            <p>Profession Type</p>
          </a>
        </li>
        @endif

        @if(view_permission('profession_category'))
        <li class="nav-item">
          <a href="{{route('basic-settings.profession-category.index')}}" class="nav-link {{$subMenu == 'ProfessionCategory'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Profession Category</p>
          </a>
        </li>
        @endif

        @if(view_permission('profession_subcategory'))
        <li class="nav-item">
          <a href="{{route('basic-settings.profession-subcategory.index')}}" class="nav-link {{$subMenu == 'ProfessionSubcategory'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Profession Subcategory</p>
          </a>
        </li>
        @endif

        @if(view_permission('road_category'))
        <li class="nav-item">
          <a href="{{route('basic-settings.road-category.index')}}" class="nav-link {{$subMenu == 'RoadCategory'?'active':''}} ">
            <i class="far fa-circle nav-icon"></i>
            <p>Road Category</p>
          </a>
        </li>
        @endif

        @if(view_permission('road_type'))
        <li class="nav-item">
          <a href="{{route('basic-settings.road-type.index')}}" class="nav-link {{$subMenu == 'RoadType'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Road Type</p>
          </a>
        </li>
        @endif

        @if(view_permission('road_owner'))
        <li class="nav-item">
          <a href="{{route('basic-settings.road-owner.index')}}" class="nav-link {{$subMenu == 'RoadOwner'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Road Owner</p>
          </a>
        </li>
        @endif

        @if(view_permission('reserve_ward'))
        <li class="nav-item">
          <a href="{{route('basic-settings.reserve-ward.index')}}" class="nav-link {{$subMenu == 'ReserveWard'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Reserve Ward</p>
          </a>
        </li>
        @endif

        @if(view_permission('union'))
        <li class="nav-item">
          <a href="{{route('basic-settings.union.index')}}" class="nav-link {{$subMenu == 'CityCorporationWard'?'active':''}} {{$subMenu =='Union'? 'active':''}} ">
            <i class="far fa-circle nav-icon"></i>
            <p>Union</p>
          </a>
        </li>
        @endif



        @if(view_permission('union_ward'))
        <li class="nav-item">
          <a href="{{route('basic-settings.union-ward.index')}}" class="nav-link {{$subMenu == 'UnionWard'?'active':''}} ">
            <i class="far fa-circle nav-icon"></i>
            <p>Union Ward</p>
          </a>
        </li>
        @endif

        @if(view_permission('vehicle_category'))
        <li class="nav-item">
          <a href="{{route('basic-settings.vehicle-category.index')}}" class="nav-link {{$subMenu == 'VehicleCategory'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Vehicle Category</p>
          </a>
        </li>
        @endif

        @if(view_permission('vehicle_type'))
        <li class="nav-item">
          <a href="{{route('basic-settings.vehicle-type.index')}}" class="nav-link {{$subMenu == 'VehicleType'?'active':''}}  ">
            <i class="far fa-circle nav-icon"></i>
            <p>Vehicle Type</p>
          </a>
        </li>
        @endif

        @if(view_permission('vehicle_subcategory'))
        <li class="nav-item">
          <a href="{{route('basic-settings.vehicle-subcategory.index')}}" class="nav-link {{$subMenu == 'VehicleSubcategory'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Vehicle Subcategory</p>
          </a>
        </li>
        @endif

        @if(view_permission('market_type'))
        <li class="nav-item">
          <a href="{{route('basic-settings.market-type.index')}}" class="nav-link {{$subMenu == 'MarketType'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Market Type</p>
          </a>
        </li>
        @endif

        @if(view_permission('market_category'))
        <li class="nav-item">
          <a href="{{route('basic-settings.market-category.index')}}" class="nav-link {{$subMenu == 'MarketCategory'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Market Category</p>
          </a>
        </li>
        @endif

        @if(view_permission('market_ownership_type'))
        <li class="nav-item">
          <a href="{{route('basic-settings.market-ownership-type.index')}}" class="nav-link {{$subMenu == 'MarketOwnershipType'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Market Ownership Type</p>
          </a>
        </li>
        @endif

        @if(view_permission('country'))
        <li class="nav-item">
          <a href="{{route('basic-settings.country.index')}}" class="nav-link {{$subMenu == 'Country'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Country</p>
          </a>
        </li>
        @endif

        @if(view_permission('village'))
        <li class="nav-item">
          <a href="{{route('basic-settings.village.index')}}" class="nav-link {{$subMenu == 'Village'?'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Village</p>
          </a>
        </li>
        @endif

        @if(view_permission('village_area'))
        <li class="nav-item">
          <a href="{{route('basic-settings.village-area.index')}}" class="nav-link {{$subMenu == 'VillageArea'?'active':''}} ">
            <i class="far fa-circle nav-icon"></i>
            <p>Village Area</p>
          </a>
        </li>
        @endif

      </ul>
    </li>
    @endcan


      @if(is_institutional_admin() || Auth::user()->can('user.read'))
      <li class="nav-item {{ $isAccessManagement ? 'menu-open' : '' }}">
               <a href="{{ route('user.index') }}" class="nav-link {{ $isAccessManagement ? 'active' : '' }}">
                 <i class="nav-icon fas fa-shield-alt"></i>
                 <p>
                   Access Management
                 </p>
               </a>
             </li>
      @endif

    @can('institute.read')
    {{-- Institute Settings --}}
    <li class="nav-item {{ $isInstituteSettings ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-university"></i>
      <p>
        Institute Settings
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">

      @can('institute.create')
      <li class="nav-item">
        <a href="{{route('institute.create')}}" class="nav-link @if($subMenu == 'InstituteCreate') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Create</p>
        </a>
      </li>
      @endcan

      @can('institute.read')
      <li class="nav-item">
        <a href="{{route('institute.index')}}" class="nav-link @if($subMenu == 'InstituteList') active @endif ">
          <i class="far fa-circle nav-icon"></i>
          <p>View</p>
        </a>
      </li>
      @endcan

    </ul>
  </li>
  @endcan

  @can('institutional-admin.read')
  <li class="nav-item {{ ($subMenu == "AdminCreate" || $subMenu == "AdminList" || $subMenu == "AdminShow") ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-users"></i>
      <p>
        Institutional Admins
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">

            @if(create_permission('institutional-admin'))
<li class="nav-item">
        <a href="{{route('institutional-admin.create')}}" class="nav-link  @if($subMenu == "AdminCreate") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Create</p>
        </a>
      </li>
      @endif

            @if(view_permission('institutional-admin'))
<li class="nav-item">
        <a href="{{route('institutional-admin.index')}}" class="nav-link  @if($subMenu == "AdminList") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>List</p>
        </a>
      </li>
      @endif

    </ul>

  </li>
  @endcan

  {{-- People Info --}}
  @if(view_permission('people'))
  <li class="nav-item {{ $isPeopleInfo ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-users"></i>
      <p>
        People Info
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">

      @if(create_permission('people'))
      <li class="nav-item">
        <a href="{{route('people.create')}}" class="nav-link @if($subMenu == "Create") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Create</p>
        </a>
      </li>
      @endif

      @if(view_permission('people'))
            @if(view_permission('applicant_list'))
<li class="nav-item">
        <a href="{{route('people.index')}}" class="nav-link @if($subMenu == "View") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Applicant List</p>
        </a>
      </li>
      @endif
      @endif

      @if(view_permission('people'))
            @if(view_permission('reg_people_list'))
<li class="nav-item">
        <a href="{{route('peopleapprovedlist')}}" class="nav-link @if($subMenu == "approvedList") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Reg. People List</p>
        </a>
      </li>
      @endif
      @endif

      @if(view_permission('people'))
            @if(view_permission('search_people'))
<li class="nav-item">
        <a href="{{route('peoplesearch')}}" class="nav-link @if($subMenu == "search") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Search People</p>
        </a>
      </li>
      @endif
      @endif

    </ul>
  </li>
  @endif

  {{-- Certificate --}}
  @if(is_superadmin() || Auth::user()->can('certificate.read'))
  <li class="nav-item {{ $isCertificate ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-certificate"></i>
      <p>
        Certificate
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
            @if(view_permission('citizen'))
<li class="nav-item">
        <a href="{{route('citizen.index')}}" class="nav-link @if($subMenu == "Citizen") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Citizen</p>
        </a>
      </li>
      @endif

            @if(view_permission('character'))
<li class="nav-item">
        <a href="{{route('character.index')}}" class="nav-link  @if($subMenu == "Character") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Character</p>
        </a>
      </li>
      @endif

             @if(view_permission('death'))
<li class="nav-item">
        <a href="{{route('death.index')}}" class="nav-link  @if($subMenu == 'Death') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Death</p>
        </a>
      </li>
      @endif

            @if(view_permission('succession'))
<li class="nav-item">
        <a href="{{route('succession.index')}}" class="nav-link  @if($subMenu == 'Succession') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Succession</p>
        </a>
      </li>
      @endif

            @if(view_permission('unmarried'))
<li class="nav-item">
        <a href="{{route('unmarried.index')}}" class="nav-link  @if($subMenu == "Unmarried") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Unmarried</p>
        </a>
      </li>
      @endif

            @if(view_permission('married'))
<li class="nav-item">
        <a href="{{route('married.index')}}" class="nav-link  @if($subMenu == "Married") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Married</p>
        </a>
      </li>
      @endif

            @if(view_permission('remarried'))
<li class="nav-item">
        <a href="{{route('remarried.index')}}" class="nav-link  @if($subMenu == "Remarried") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Remarried</p>
        </a>
      </li>
      @endif

            @if(view_permission('landless'))
<li class="nav-item">
        <a href="{{route('landless.index')}}" class="nav-link  @if($subMenu == "Landless") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Landless</p>
        </a>
      </li>
      @endif

            @if(view_permission('name'))
<li class="nav-item">
        <a href="{{route('name.index')}}" class="nav-link  @if($subMenu == "Name") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Name</p>
        </a>
      </li>
      @endif

            @if(view_permission('income'))
<li class="nav-item">
        <a href="{{route('income.index')}}" class="nav-link  @if($subMenu == "Income") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Yearly Income</p>
        </a>
      </li>
      @endif

            @if(view_permission('disability_certificate'))
<li class="nav-item">
        <a href="{{route('disability-certificate.index')}}" class="nav-link  @if($subMenu == "Disability") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Disability</p>
        </a>
      </li>
      @endif

      {{-- <li class="nav-item">
        <a href="{{route('birth.index')}}" class="nav-link  @if($subMenu == 'Birth') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Objection</p>
        </a>
      </li> --}}

            @if(view_permission('voter_area'))
<li class="nav-item">
        <a href="{{route('voter-area.index')}}" class="nav-link  @if($subMenu == "VoterArea") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Voter Area Change</p>
        </a>
      </li>
      @endif

            @if(view_permission('voter_list'))
<li class="nav-item">
        <a href="{{route('voter-list.index')}}" class="nav-link  @if($subMenu == "VoterList") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Not Voter List</p>
        </a>
      </li>
      @endif

            @if(view_permission('nid_correction'))
<li class="nav-item">
        <a href="{{route('nid-correction.index')}}" class="nav-link  @if($subMenu == "NidCorrection") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>NID Correction</p>
        </a>
      </li>
      @endif

            @if(view_permission('childless'))
<li class="nav-item">
        <a href="{{route('childless.index')}}" class="nav-link  @if($subMenu == "Childless") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Childless</p>
        </a>
      </li>
      @endif

            @if(view_permission('orphan'))
<li class="nav-item">
        <a href="{{route('orphan.index')}}" class="nav-link  @if($subMenu == "Orphan") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Orphan</p>
        </a>
      </li>
      @endif

            @if(view_permission('financial_instability'))
<li class="nav-item">
        <a href="{{route('financial-instability.index')}}" class="nav-link  @if($subMenu == "FinancialInstability") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Financial Instability</p>
        </a>
      </li>
      @endif

            @if(view_permission('age'))
<li class="nav-item">
        <a href="{{route('age.index')}}" class="nav-link  @if($subMenu == "Age") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Age</p>
        </a>
      </li>
      @endif

            @if(view_permission('permanent_citizen'))
<li class="nav-item">
        <a href="{{route('permanent-citizen.index')}}" class="nav-link  @if($subMenu == "PermanentCitizen") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Permanent Citizen</p>
        </a>
      </li>
      @endif

      {{-- <li class="nav-item">
        <a href="{{route('birth.index')}}" class="nav-link  {{$subMenu == 'Birth'?'active'?''}}">
          <i class="far fa-circle nav-icon"></i>
          <p>Alive</p>
        </a>
      </li> --}}

            @if(view_permission('residential'))
<li class="nav-item">
        <a href="{{route('residential.index')}}" class="nav-link  @if($subMenu == 'Residential') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Residential</p>
        </a>
      </li>
      @endif

            @if(view_permission('guardian_income'))
<li class="nav-item">
        <a href="{{route('guardian-income.index')}}" class="nav-link  @if($subMenu == "GuardianIncome") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Guardian Income</p>
        </a>
      </li>
      @endif

            @if(view_permission('guardian_acceptance'))
<li class="nav-item">
        <a href="{{route('guardian-acceptance.index')}}" class="nav-link  @if($subMenu == "GuardianAcceptance") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Guardian Acceptance</p>
        </a>
      </li>
      @endif

            @if(view_permission('inheritance'))
<li class="nav-item">
        <a href="{{route('inheritance.index')}}" class="nav-link  @if($subMenu == "Inheritance") active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Inheritance</p>
        </a>
      </li>
      @endif

<!-- GENERATED ADMIN CERTS -->
            @if(view_permission('birth_registration_correction'))
<li class="nav-item">
        <a href="{{route('birth-registration-correction.index')}}" class="nav-link  @if($subMenu == 'BirthRegistrationCorrection') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Birth Reg Correction</p>
        </a>
      </li>
      @endif

            @if(view_permission('new_voter_recommendation'))
<li class="nav-item">
        <a href="{{route('new-voter-recommendation.index')}}" class="nav-link  @if($subMenu == 'NewVoterRecommendation') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>New Voter Recommendation</p>
        </a>
      </li>
      @endif

            @if(view_permission('voter_registration_agreement'))
<li class="nav-item">
        <a href="{{route('voter-registration-agreement.index')}}" class="nav-link  @if($subMenu == 'VoterRegistrationAgreement') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Voter Reg Agreement</p>
        </a>
      </li>
      @endif

            @if(view_permission('not_rohingya'))
<li class="nav-item">
        <a href="{{route('not-rohingya.index')}}" class="nav-link  @if($subMenu == 'NotRohingya') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Not Rohingya</p>
        </a>
      </li>
      @endif

            @if(view_permission('passport_related'))
<li class="nav-item">
        <a href="{{route('passport-related.index')}}" class="nav-link  @if($subMenu == 'PassportRelated') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Passport Related</p>
        </a>
      </li>
      @endif

            @if(view_permission('family'))
<li class="nav-item">
        <a href="{{route('family.index')}}" class="nav-link  @if($subMenu == 'Family') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Family</p>
        </a>
      </li>
      @endif

            @if(view_permission('alive'))
<li class="nav-item">
        <a href="{{route('alive.index')}}" class="nav-link  @if($subMenu == 'Alive') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Alive</p>
        </a>
      </li>
      @endif

            @if(view_permission('missing_person'))
<li class="nav-item">
        <a href="{{route('missing-person.index')}}" class="nav-link  @if($subMenu == 'MissingPerson') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Missing Person</p>
        </a>
      </li>
      @endif

            @if(view_permission('abandoned_by_husband'))
<li class="nav-item">
        <a href="{{route('abandoned-by-husband.index')}}" class="nav-link  @if($subMenu == 'AbandonedByHusband') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Abandoned By Husband</p>
        </a>
      </li>
      @endif

            @if(view_permission('widow'))
<li class="nav-item">
        <a href="{{route('widow.index')}}" class="nav-link  @if($subMenu == 'Widow') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Widow</p>
        </a>
      </li>
      @endif

            @if(view_permission('dependency'))
<li class="nav-item">
        <a href="{{route('dependency.index')}}" class="nav-link  @if($subMenu == 'Dependency') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Dependency</p>
        </a>
      </li>
      @endif

            @if(view_permission('dowryless'))
<li class="nav-item">
        <a href="{{route('dowryless.index')}}" class="nav-link  @if($subMenu == 'Dowryless') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Dowryless</p>
        </a>
      </li>
      @endif

            @if(view_permission('unemployment'))
<li class="nav-item">
        <a href="{{route('unemployment.index')}}" class="nav-link  @if($subMenu == 'Unemployment') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Unemployment</p>
        </a>
      </li>
      @endif

            @if(view_permission('helplessness'))
<li class="nav-item">
        <a href="{{route('helplessness.index')}}" class="nav-link  @if($subMenu == 'Helplessness') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Helplessness</p>
        </a>
      </li>
      @endif

            @if(view_permission('illiteracy'))
<li class="nav-item">
        <a href="{{route('illiteracy.index')}}" class="nav-link  @if($subMenu == 'Illiteracy') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Illiteracy</p>
        </a>
      </li>
      @endif

            @if(view_permission('agriculture'))
<li class="nav-item">
        <a href="{{route('agriculture.index')}}" class="nav-link  @if($subMenu == 'Agriculture') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Agriculture</p>
        </a>
      </li>
      @endif

            @if(view_permission('fisherman'))
<li class="nav-item">
        <a href="{{route('fisherman.index')}}" class="nav-link  @if($subMenu == 'Fisherman') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Fisherman</p>
        </a>
      </li>
      @endif

            @if(view_permission('professional'))
<li class="nav-item">
        <a href="{{route('professional.index')}}" class="nav-link  @if($subMenu == 'Professional') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Professional</p>
        </a>
      </li>
      @endif

            @if(view_permission('farmer_fuel_oil_card'))
<li class="nav-item">
        <a href="{{route('farmer-fuel-oil-card.index')}}" class="nav-link  @if($subMenu == 'FarmerFuelOilCard') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Farmer Fuel Card</p>
        </a>
      </li>
      @endif

            @if(view_permission('no_objection'))
<li class="nav-item">
        <a href="{{route('no-objection.index')}}" class="nav-link  @if($subMenu == 'NoObjection') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>No Objection</p>
        </a>
      </li>
      @endif

            @if(view_permission('general'))
<li class="nav-item">
        <a href="{{route('general.index')}}" class="nav-link  @if($subMenu == 'General') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>General</p>
        </a>
      </li>
      @endif

            @if(view_permission('infrastructure_construction_permission'))
<li class="nav-item">
        <a href="{{route('infrastructure-construction-permission.index')}}" class="nav-link  @if($subMenu == 'InfrastructureConstructionPermission') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Infra Const Permission</p>
        </a>
      </li>
      @endif

            @if(view_permission('power_of_attorney'))
<li class="nav-item">
        <a href="{{route('power-of-attorney.index')}}" class="nav-link  @if($subMenu == 'PowerOfAttorney') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Power Of Attorney</p>
        </a>
      </li>
      @endif

            @if(view_permission('ethnic_minority'))
<li class="nav-item">
        <a href="{{route('ethnic-minority.index')}}" class="nav-link  @if($subMenu == 'EthnicMinority') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Ethnic Minority</p>
        </a>
      </li>
      @endif

            @if(view_permission('tribal'))
<li class="nav-item">
        <a href="{{route('tribal.index')}}" class="nav-link  @if($subMenu == 'Tribal') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Tribal</p>
        </a>
      </li>
      @endif

            @if(view_permission('indigenous'))
<li class="nav-item">
        <a href="{{route('indigenous.index')}}" class="nav-link  @if($subMenu == 'Indigenous') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Indigenous</p>
        </a>
      </li>
      @endif



    </ul>
  </li>
  @endif

  {{-- Organization Info --}}
  @can('organization.read')
  <li class="nav-item {{ $isOrganization ? 'menu-open' : '' }}">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-briefcase"></i>
    <p>
      Organization
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">

    @can('organization.create')
          @if(create_permission('organization'))
<li class="nav-item">
      <a href="{{route('organization.create')}}" class="nav-link @if($subMenu == "OrganizationCreate") active @endif">
        <i class="far fa-circle nav-icon"></i>
        <p>Create</p>
      </a>
    </li>
      @endif
    @endcan

          @if(view_permission('applicant_org_list'))
<li class="nav-item">
      <a href="{{route('organization.index')}}" class="nav-link @if($subMenu == "OrganizationList") active @endif">
        <i class="far fa-circle nav-icon"></i>
        <p>Applicant Org. List</p>
      </a>
    </li>
      @endif

          @if(view_permission('approved_org_list'))
<li class="nav-item">
      <a href="{{route('orgapproved_index')}}" class="nav-link @if($subMenu == "ApprovedOrganizationList") active @endif">
        <i class="far fa-circle nav-icon"></i>
        <p>Approved Org. List</p>
      </a>
    </li>
      @endif

          @if(view_permission('org_fees'))
<li class="nav-item">
      <a href="{{route('organizationA.registration-fees.index')}}" class="nav-link @if($subMenu == "RegistrationFees") active @endif">
        <i class="far fa-circle nav-icon"></i>
        <p>Fees</p>
      </a>
    </li>
      @endif

          @if(view_permission('org_generate_invoice'))
<li class="nav-item">
      <a href="{{route('organizationA.trade-license.index')}}" class="nav-link @if($subMenu == "TradeLicense") active @endif">
        <i class="far fa-circle nav-icon"></i>
        <p>Generate Invoice </p>
      </a>
    </li>
      @endif

    <li class="nav-item">
      <a href="{{ route('organization.transfer.index') }}" class="nav-link @if($subMenu == "OrganizationTransferRequest") active @endif">
        <i class="far fa-circle nav-icon"></i>
        <p>Transfer Request</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('organization.transfer.incoming') }}" class="nav-link @if($subMenu == "IncomingTransferRequest") active @endif">
        <i class="far fa-circle nav-icon"></i>
        <p>Incoming Transfer Request</p>
      </a>
    </li>

    @can('organization.create')
          @if(view_permission('trade_license'))
<li class="nav-item">
      <a href="{{route('organizationA.trade-license.getTradeLicense')}}" class="nav-link @if($subMenu == "GetTradeLicense") active @endif">
        <i class="far fa-circle nav-icon"></i>
        <p>Trade License</p>
      </a>
    </li>
      @endif
    @endcan

  </ul>
  </li>
  @endif



{{-- Tax --}}
@can('tax.read')
<li class="nav-item {{ $isTax ? 'menu-open' : '' }}">
<a href="#" class="nav-link">
  <i class="nav-icon fas fa-money-bill"></i>
  <p>
    Tax
    <i class="right fas fa-angle-left"></i>
  </p>
</a>
<ul class="nav nav-treeview">

        @if(view_permission('tax_generate'))
<li class="nav-item">
    <a href="{{route('tax.create')}}" class="nav-link  @if($subMenu == "TaxGenerate") active @endif">
      <i class="far fa-circle nav-icon"></i>
      <p>Tax Generate</p>
    </a>
  </li>
      @endif

        @if(view_permission('tax_list'))
<li class="nav-item">
    <a href="{{route('tax.index')}}" class="nav-link @if($subMenu == "TaxList") active @endif">
      <i class="far fa-circle nav-icon"></i>
      <p>Tax List</p>
    </a>
  </li>
      @endif

        @if(view_permission('tax_received'))
<li class="nav-item">
    <a href="{{route('taxes.tax.received')}}" class="nav-link @if($subMenu == "TaxReceived") active @endif">
      <i class="far fa-circle nav-icon"></i>
      <p>Tax Received</p>
    </a>
  </li>
      @endif

</ul>
  </li>
  @endif

{{-- Relief Card --}}
@if(is_superadmin() || Auth::user()->can('relief_card.read'))
<li class="nav-item {{ $isReliefCard ? 'menu-open' : '' }}">
  <a href="{{ route('relief-card.index') }}" class="nav-link {{ $isReliefCard ? 'active' : '' }}">
    <i class="nav-icon fas fa-hand-holding-heart"></i>
    <p>Relief Card</p>
  </a>
</li>
@endif

          @can('house.read')
          <li class="nav-item {{ $isHouse ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              House Info
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            @can('house.create')
            <li class="nav-item">
              <a href="{{route('house.create')}}" class="nav-link @if($subMenu == "HouseCreate") active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>
            @endcan

            <li class="nav-item">
              <a href="{{route('house.index')}}" class="nav-link @if($subMenu == "HouseList") active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>House List</p>
              </a>
            </li>

          </ul>
        </li>
        @endcan

        {{-- Land Info --}}
        @can('land.read')
        <li class="nav-item {{ $isLand ? 'menu-open' : '' }}">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-bacon"></i>
          <p>
            Land Info
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

          @can('land.create')
          <li class="nav-item">
            <a href="{{route('land.create')}}" class="nav-link @if($subMenu == "LandCreate") active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Create</p>
            </a>
          </li>
          @endcan

          <li class="nav-item">
            <a href="{{route('land.index')}}" class="nav-link @if($subMenu == "LandList") active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>List</p>
            </a>
          </li>

        </ul>
      </li>
      @endcan



      {{-- Vehicle Info --}}
      @can('vehicle.read')
      <li class="nav-item {{ $isVehicle ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-truck"></i>
        <p>
          Vehicle Info
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">

        @can('vehicle.create')
              @if(create_permission('vehicle'))
<li class="nav-item">
          <a href="{{route('vehicle.create')}}" class="nav-link @if( $subMenu == "VehicleCreate") active @endif">
            <i class="far @if($subMenu == "VehicleCreate") fa-dot-circle @else fa-circle @endif nav-icon"></i>
            <p>Create</p>
          </a>
        </li>
      @endif
        @endcan

              @if(view_permission('vehicle_application_list'))
<li class="nav-item">
          <a href="{{route('vehicle.index')}}" class="nav-link @if( $subMenu == "VehicleList") active @endif">
            <i class="far @if($subMenu == "VehicleList") fa-dot-circle @else fa-circle @endif nav-icon"></i>
            <p>Application List</p>
          </a>
        </li>
      @endif

        <li class="nav-item">
          <a href="{{ route('vehicle.approval.list') }}" class="nav-link @if( $subMenu == "VehicleApprovalList") active @endif">
            <i class="far @if($subMenu == "VehicleApprovalList") fa-dot-circle @else fa-circle @endif nav-icon"></i>
            <p>Approval List</p>
          </a>
        </li>

        <li class="nav-item has-treeview @if($subMenu == "VehicleAddFeesNewSetup" || $subMenu == "VehicleAddFeesList") menu-open @endif">
          <a href="#" class="nav-link @if($subMenu == "VehicleAddFeesNewSetup" || $subMenu == "VehicleAddFeesList") active @endif">
            <i class="far @if($subMenu == "VehicleAddFeesNewSetup" || $subMenu == "VehicleAddFeesList") fa-dot-circle @else fa-circle @endif nav-icon"></i>
            <p>
              Fees
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
                  @if(view_permission('vehicle_fees_new'))
<li class="nav-item">
              <a href="{{route('vehicle.fees.vehicle')}}" class="nav-link @if( $subMenu == "VehicleAddFeesNewSetup") active @endif">
                <i class="far @if($subMenu == "VehicleAddFeesNewSetup") fa-dot-circle @else fa-circle @endif nav-icon"></i>
                <p>New</p>
              </a>
            </li>
      @endif
                  @if(view_permission('vehicle_fees_list'))
<li class="nav-item">
              <a href="{{route('vehicle.fees.list')}}" class="nav-link @if( $subMenu == "VehicleAddFeesList") active @endif">
                <i class="far @if($subMenu == "VehicleAddFeesList") fa-dot-circle @else fa-circle @endif nav-icon"></i>
                <p>Fees List</p>
              </a>
            </li>
      @endif
          </ul>
        </li>

        <li class="nav-item">
          <a href="{{ route('vehicle.invoice.list') }}" class="nav-link @if( $subMenu == "VehicleGenerateInvoice") active @endif">
            <i class="far @if($subMenu == "VehicleGenerateInvoice") fa-dot-circle @else fa-circle @endif nav-icon"></i>
            <p>Generate Invoice</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('vehicle.license.list') }}" class="nav-link @if( $subMenu == "VehicleLicense") active @endif">
            <i class="far @if($subMenu == "VehicleLicense") fa-dot-circle @else fa-circle @endif nav-icon"></i>
            <p>License</p>
          </a>
        </li>

        {{-- Ownership Change - Routes not defined
        <li class="nav-item has-treeview @if($subMenu == "VehicleOwnershipChangeApplication" || $subMenu == "VehicleOwnershipChangeApproval") menu-open @endif">
          <a href="#" class="nav-link @if($subMenu == "VehicleOwnershipChangeApplication" || $subMenu == "VehicleOwnershipChangeApproval") active @endif">
            <i class="far @if($subMenu == "VehicleOwnershipChangeApplication" || $subMenu == "VehicleOwnershipChangeApproval") fa-dot-circle @else fa-circle @endif nav-icon"></i>
            <p>
              Ownership Change
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link @if( $subMenu == "VehicleOwnershipChangeApplication") active @endif">
                <i class="far @if($subMenu == "VehicleOwnershipChangeApplication") fa-dot-circle @else fa-circle @endif nav-icon"></i>
                <p>Application</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link @if( $subMenu == "VehicleOwnershipChangeApproval") active @endif">
                <i class="far @if($subMenu == "VehicleOwnershipChangeApproval") fa-dot-circle @else fa-circle @endif nav-icon"></i>
                <p>Approval</p>
              </a>
            </li>
          </ul>
        </li>
        --}}

      </ul>
    </li>
    @endif

    {{-- Local Govt. Judiciary --}}
    @if(is_superadmin() || Auth::user()->can('village_court.read'))
    <li class="nav-item {{ (isset($subMenu) && in_array($subMenu, ['VillageCourtCreate', 'VillageCourtList', 'VillageCourtAdalotGothon', 'VillageCourtShunani', 'VillageCourtRayGhoshona'])) ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-balance-scale"></i>
        <p>
          Local Govt. Judiciary
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('village-court.create') }}" class="nav-link @if(isset($subMenu) && $subMenu == 'VillageCourtCreate') active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Create Case / মামলা তৈরি</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('village-court.index') }}" class="nav-link @if(isset($subMenu) && $subMenu == 'VillageCourtList') active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Case List / মামলার তালিকা</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('village-court.court_formed_list') }}" class="nav-link @if(isset($subMenu) && $subMenu == 'VillageCourtAdalotGothon') active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Court Formed List / আদালত গঠন তালিকা</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('village-court.hearing_list') }}" class="nav-link @if(isset($subMenu) && $subMenu == 'VillageCourtShunani') active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Hearing List / শুনানির তালিকা</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('village-court.verdict_list') }}" class="nav-link @if(isset($subMenu) && $subMenu == 'VillageCourtRayGhoshona') active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Verdict List / রায় ঘোষণার তালিকা</p>
          </a>
        </li>
      </ul>
    </li>
    @endif

    {{-- Road Info --}}
    @can('road.read')
    <li class="nav-item {{ $isRoad ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-road"></i>
        <p>
          Road Info
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">

        @can('road.create')
        <li class="nav-item">
          <a href="{{route('road.create')}}" class="nav-link @if($subMenu == "RoadCreate") active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Create</p>
          </a>
        </li>
        @endcan

        <li class="nav-item">
          <a href="{{route('road.index')}}" class="nav-link @if($subMenu == "RoadList") active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Road List</p>
          </a>
        </li>

      </ul>
    </li>
    @endcan

    {{-- Market Info --}}
    @can('market.read')
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-store"></i>
        <p>
          Market Info
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        @can('market.create')
        <li class="nav-item">
          <a href="{{route('market.create')}}" class="nav-link @if($subMenu == "MarketCreate") active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>Create</p>
          </a>
        </li>
        @endcan

        <li class="nav-item">
          <a href="{{route('market.index')}}" class="nav-link @if($subMenu == "MarketList") active @endif ">
            <i class="far fa-circle nav-icon"></i>
            <p>Market List</p>
          </a>
        </li>

      </ul>
    </li>
    @endcan

    {{-- Ferry Info --}}
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-ship"></i>
              <p>
                Ferry Info
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              @if (create_permission())
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
              @endif

              @if (view_permission())
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View</p>
                  </a>
                </li>
              @endif

            </ul>
          </li> -->

          {{-- River & Cannel Info --}}
         <!--  <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-water"></i>
              <p>
                River & Cannel Info
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              @if (create_permission())
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
              @endif

              @if (view_permission())
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View</p>
                  </a>
                </li>
              @endif

            </ul>
          </li> -->

          {{-- Animals Info --}}
           <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-horse"></i>
              <p>
                Animals Info
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              @if (create_permission())
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
              @endif

              @if (view_permission())
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View</p>
                  </a>
                </li>
              @endif


            </ul>
          </li> -->

          {{-- Archeology Info --}}
           <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-landmark"></i>
              <p>
                Archeology Info
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (create_permission())
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
              @endif

              @if (view_permission())
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View</p>
                  </a>
                </li>
              @endif

            </ul>
          </li> -->

          {{-- Wedding --}}
          @can('marriage.read')
          <li class="nav-item {{ $isWedding ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-ring"></i>
            <p>
             Marriage & Divorce
             <i class="right fas fa-angle-left"></i>
           </p>
          </a>
         <ul class="nav nav-treeview">

          @can('marriage.create')
          <li class="nav-item">
            <a href="{{route('marriage.create')}}" class="nav-link @if($subMenu ==  "MarriageCreate") active @endif ">
              <i class="far fa-circle nav-icon"></i>
              <p>Marriage Reg.</p>
            </a>
          </li>
          @endcan

          <li class="nav-item">
            <a href="{{route('marriage.index')}}" class="nav-link @if($subMenu ==  "MarriageList") active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>View Marriage List</p>
            </a>
          </li>

          @can('marriage.create')
          <li class="nav-item">
            <a href="{{route('divorce.create')}}" class="nav-link @if($subMenu ==  "DivorceCreate") active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Divorce Reg</p>
            </a>
          </li>
          @endcan

          <li class="nav-item">
            <a href="{{route('divorce.index')}}" class="nav-link {{$subMenu =='DivorceList' ?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>View Divorce List</p>
            </a>
          </li>

        </ul>
      </li>
      @endcan

      {{-- Chairman Info --}}
      @can('chairman.read')
      <li class="nav-item {{ $isChairman ? 'menu-open' : '' }}">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-user-tie"></i>
          <p>
            Chairman Info
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

          @can('chairman.create')
          <li class="nav-item ">
            <a href="{{route('chairman.create')}}" class="nav-link {{$subMenu ==  'chairmanCreate'?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Add New Chairman</p>
            </a>
          </li>
          @endcan

          <li class="nav-item ">
            <a href="{{route('chairman.chairmanList')}}" class="nav-link {{$subMenu ==  'chairmanList'?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Chairman List</p>
            </a>
          </li>
          
          <li class="nav-item ">
            <a href="{{route('chairman.memberList')}}" class="nav-link {{$subMenu ==  'memberList'?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Members List</p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="{{route('chairman.reserveMemberList')}}" class="nav-link {{$subMenu ==  'reserveMemberList'?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Reserve Members</p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="{{route('chairman.panelList')}}" class="nav-link {{$subMenu ==  'panelList'?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Panel</p>
            </a>
          </li>

        </ul>
    </li>
    @endif

      @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
