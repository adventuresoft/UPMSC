<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>CLMS | @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins')}}/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins')}}/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins')}}/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins')}}/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend')}}/css/adminlte.min.css">
   <!-- Toastr -->
   <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins')}}/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins')}}/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins')}}/summernote/summernote-bs4.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins')}}/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{ asset('plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('assets/style/upms-theme.css') }}">
  <style>
    :root {
        --upms-green: #10d915;
        --upms-deep-green: #046307;
        --upms-sidebar: #ffffff;
        --upms-sidebar-dark: #f8fafc;
        --upms-text: #213243;
        --upms-sidebar-border: #e6eef3;
    }

    .main-header.navbar-upms {
        background: var(--upms-deep-green);
        border-bottom: 0;
        box-shadow: 0 4px 18px rgba(4, 99, 7, 0.18);
        min-height: 58px;
    }

    .main-header.navbar-upms .nav-link {
        color: #ffffff !important;
    }

    .main-header.navbar-upms .nav-link:hover,
    .main-header.navbar-upms .nav-link:focus {
        background: rgba(255, 255, 255, 0.12);
        color: #ffffff !important;
    }

    .main-header.navbar-upms .navbar-nav > .nav-item > .nav-link {
        border-radius: 6px;
        margin: 0 3px;
        font-weight: 600;
    }

    .main-sidebar {
        background: var(--upms-sidebar) !important;
        border-right: 1px solid var(--upms-sidebar-border) !important;
        box-shadow: none !important;
    }

    .brand-link {
        display: flex;
        align-items: center;
        min-height: 70px;
        background: var(--upms-sidebar) !important;
        border-bottom: 1px solid var(--upms-sidebar-border) !important;
        color: var(--upms-text) !important;
        font-weight: 700;
    }

    .brand-link .brand-text {
        color: #071b08 !important;
        font-weight: 700 !important;
        letter-spacing: .2px;
    }

    .brand-link .brand-image {
        background: #ffffff;
        border: 2px solid rgba(255, 255, 255, 0.75);
        opacity: 1 !important;
    }

    .sidebar {
        max-height: calc(100vh - 70px);
        overflow-y: auto;
        overflow-x: hidden;
    }

    .nav-sidebar {
        padding-top: 8px;
        padding-bottom: 20px;
    }

    .nav-sidebar .nav-item > .nav-link {
        color: rgba(33, 50, 67, 0.9) !important;
        border-radius: 8px;
        margin: 6px 8px;
        transition: background-color .18s ease, color .18s ease, transform .18s ease;
        background: transparent !important;
    }

    .nav-sidebar .nav-item > .nav-link p,
    .nav-sidebar .nav-item > .nav-link i {
        color: inherit !important;
    }

    .nav-sidebar .nav-link:hover {
        background-color: rgba(4, 99, 7, 0.06) !important;
        color: var(--upms-deep-green) !important;
        transform: translateX(1px);
    }

    .nav-sidebar > .nav-item.menu-open > .nav-link:not(.active) {
        background: rgba(33, 50, 67, 0.04) !important;
        color: var(--upms-text) !important;
    }

    .nav-sidebar .nav-treeview {
        margin: 2px 8px 6px;
        padding: 4px 0;
        background: var(--upms-sidebar-dark);
        border-radius: 8px;
    }

    /* Ensure submenu text is dark so it's visible on light sidebar */
    .nav-sidebar .nav-treeview > .nav-item > .nav-link,
    .nav-sidebar .nav-treeview > .nav-item > .nav-link p,
    .nav-sidebar .nav-treeview > .nav-item > .nav-link i {
        color: var(--upms-text) !important;
        font-weight: 600;
    }

    .nav-sidebar .nav-treeview > .nav-item > .nav-link:hover {
        color: var(--upms-deep-green) !important;
    }

    .nav-sidebar .nav-treeview > .nav-item > .nav-link {
        margin: 1px 6px;
        color: rgba(255, 255, 255, 0.74) !important;
        font-size: 14px;
    }

    .nav-sidebar .nav-treeview > .nav-item > .nav-link.active,
    .nav-sidebar .nav-link.active,
    .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active,
    .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active {
        background: transparent !important;
        color: var(--upms-deep-green) !important;
        border-left: 3px solid var(--upms-deep-green);
        padding-left: calc(1rem - 3px) !important;
    }

    .nav-sidebar .nav-treeview > .nav-item > .nav-link.active i,
    .nav-sidebar .nav-link.active i,
    .nav-sidebar .nav-treeview > .nav-item > .nav-link.active p,
    .nav-sidebar .nav-link.active p {
        color: #071b08 !important;
    }

    .content-wrapper {
        background: #eef2f7;
        margin-top: 0 !important;
        padding: 1rem !important;
    }

    .content-wrapper > .content {
        margin-top: 0 !important;
    }

    .main-footer {
        border-top: 1px solid #dbe5df;
        color: #64748b;
    }

    /* Global: Prevent horizontal scrollbars on all DataTable pages */
    .card-body {
        overflow-x: hidden;
    }

    /* Force card-info header to gray instead of cyan */
    .card.card-info > .card-header,
    .card-info > .card-header {
        background: #f3f4f6 !important;
        border-bottom-color: #e6eef3 !important;
        color: #6b7a86 !important;
    }

    .card.card-info > .card-header .card-title,
    .card-info > .card-header .card-title {
        color: #6b7a86 !important;
    }

    .card.card-info > .card-header .btn,
    .card-info > .card-header .btn {
        background: #1f2937 !important;
        border-color: #1f2937 !important;
        color: #ffffff !important;
    }
    
    /* Ensure DataTables Responsive collapse works cleanly */
    table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control::before,
    table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control::before {
        background-color: #17a2b8;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 17px !important;
    }
    .select2 {
width:100%!important;
}
    .table-action{
      display: flex;
      gap: 8px;
    }
  </style>
  @stack('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    @if(Auth::guard('web')->check())
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @elseif(Auth::guard('people')->check())
        <form id="logoutForm" action="{{ route('people.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endif
<div class="wrapper">

  <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center"> --}}
      {{-- <h3 class="animation__shake"><i class="fas fa-tachometer-alt"></i>UPMS</h3> --}}
    {{-- <img class="animation__shake" src="{{ asset('backend')}}/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60"> --}}
  {{-- </div> --}}

  <!-- Navbar -->
@include('backend.layouts.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('backend.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  @include('backend.layouts.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins') }}/jquery/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins')}}/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins')}}/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins')}}/sparklines/sparkline.js"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins')}}/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('plugins')}}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('plugins')}}/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('plugins')}}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('plugins')}}/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('plugins')}}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('plugins')}}/jszip/jszip.min.js"></script>
<script src="{{ asset('plugins')}}/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('plugins')}}/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('plugins')}}/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('plugins')}}/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('plugins')}}/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins')}}/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins')}}/moment/moment.min.js"></script>
<script src="{{ asset('plugins')}}/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins')}}/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

<!-- sweetalert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins')}}/summernote/summernote-bs4.min.js"></script>
<!-- Select2 -->
<script src="{{ asset('plugins')}}/select2/js/select2.full.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins')}}/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend')}}/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend')}}/js/demo.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.btn-delete-confirm', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "This action will soft-delete the record. You can recover it later if needed.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, Delete it!',
            cancelButtonText: 'No, Cancel',
            reverseButtons: true,
            customClass: {
                confirmButton: 'btn btn-primary px-4 mx-2',
                cancelButton: 'btn btn-outline-secondary px-4 mx-2'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif
    @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif
    @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
    @endif
    @if(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
    @endif

    // Sidebar Scroll Persistence & Active Item Focus
    $(document).ready(function() {
        var sidebar = $('.sidebar');
        var storageKey = 'sidebar-scroll';
        
        var initSidebarScroll = function() {
            var osInstance = sidebar.overlayScrollbars();
            var savedScroll = localStorage.getItem(storageKey);
            
            if (osInstance) {
                // Restore scroll position instantly
                if (savedScroll !== null) {
                    osInstance.scroll({ y: savedScroll }, 0);
                } else {
                    var activeItem = $('.nav-link.active');
                    if (activeItem.length > 0) {
                        osInstance.scroll(activeItem, 0);
                    }
                }
                
                // Show sidebar smoothly after positioning
                sidebar.css('opacity', '1');
                
                // Save scroll position on scroll
                osInstance.options({
                    callbacks: {
                        onScroll: function() {
                            localStorage.setItem(storageKey, this.scroll().position.y);
                        }
                    }
                });
            }
        };

        // Initialize multiple times to catch potential timing issues
        initSidebarScroll();
        setTimeout(initSidebarScroll, 50);
        setTimeout(initSidebarScroll, 200);

        // Save on click
        $(document).on('click', '.nav-link', function() {
            var osInstance = sidebar.overlayScrollbars();
            if (osInstance) {
                localStorage.setItem(storageKey, osInstance.scroll().position.y);
            }
        });
    });
</script>


@stack('script')



</body>
</html>
