<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>People Portal | @yield('title', 'Welcome')</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #64748b;
            --accent: #f59e0b;
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            margin: 0;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
        }

        /* Sidebar */
        .portal-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-box {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .sidebar-menu {
            padding: 20px 16px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border-radius: 12px;
            color: var(--secondary);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.2s ease;
            margin-bottom: 4px;
        }

        .nav-link:hover {
            background: #f1f5f9;
            color: var(--primary);
        }

        .nav-link.active {
            background: #eff6ff;
            color: var(--primary);
        }

        .nav-link i {
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        /* Main Content */
        .portal-main {
            margin-left: var(--sidebar-width);
            margin-top: 3rem;
            min-height: 100vh;
            padding: 32px;
            transition: all 0.3s ease;
        }

        /* Header */
        .portal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .user-pill {
            background: white;
            padding: 6px 16px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: #e2e8f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--primary);
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Cards */
        .premium-card {
            background: var(--bg-card);
            border-radius: 20px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.03);
            overflow: hidden;
            transition: transform 0.2s ease;
        }

        .premium-card:hover {
            transform: translateY(-2px);
        }

        .card-body-premium {
            padding: 24px;
        }

        /* Buttons */
        .btn-premium {
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-primary-premium {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            color: white;
        }

        .btn-primary-premium:hover {
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
            transform: translateY(-1px);
        }

        /* Animations */
        .fade-in-up {
            animation: fadeInUp 0.5s ease forwards;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 992px) {
            .portal-sidebar {
                transform: translateX(-100%);
            }
            .portal-main {
                margin-left: 0;
            }
            .portal-sidebar.active {
                transform: translateX(0);
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/style/upms-theme.css') }}">
    @stack('css')
</head>
<body>

    <!-- Sidebar -->
    <aside class="portal-sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo-box">
                <i class="fas fa-fingerprint"></i>
            </div>
            <div>
                <h5 class="mb-0">Portal</h5>
                <small class="text-muted">Digital Citizen</small>
            </div>
        </div>

        <nav class="sidebar-menu">
            <a href="{{ route('people.dashboard') }}" class="nav-link {{ request()->routeIs('people.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('people.profile') }}" class="nav-link {{ request()->routeIs('people.profile') ? 'active' : '' }}">
                <i class="fas fa-user-circle"></i>
                <span>My Profile</span>
            </a>
            <a href="{{ route('people.password.change') }}" class="nav-link {{ request()->routeIs('people.password.change') ? 'active' : '' }}">
                <i class="fas fa-shield-alt"></i>
                <span>Security</span>
            </a>
            
            <hr class="my-4 border-slate-100">
            
            <a href="#" onclick="event.preventDefault(); document.getElementById('portalLogoutForm').submit();" class="nav-link text-danger">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
            <form id="portalLogoutForm" action="{{ route('people.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="portal-main">
        <header class="portal-header">
            <div>
                <button class="btn btn-sm btn-outline-secondary d-lg-none me-2" id="toggleSidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <h2 class="mb-1">@yield('page_title', 'Dashboard')</h2>
                <p class="text-muted mb-0">Welcome back, {{ Auth::guard('people')->user()->name }}</p>
            </div>

            <div class="user-pill d-none d-md-flex">
                <div class="user-avatar">
                    @if(Auth::guard('people')->user()->image)
                        <img src="{{ asset(Auth::guard('people')->user()->image) }}" alt="Avatar">
                    @else
                        {{ strtoupper(substr(Auth::guard('people')->user()->name, 0, 1)) }}
                    @endif
                </div>
                <div class="text-start">
                    <p class="mb-0 fw-semibold" style="font-size: 14px;">{{ Auth::guard('people')->user()->name }}</p>
                    <small class="text-muted" style="font-size: 12px;">ID: {{ Auth::guard('people')->user()->approved_id }}</small>
                </div>
            </div>
        </header>

        <div class="fade-in-up">
            @yield('content')
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#toggleSidebar').click(function() {
                $('#sidebar').toggleClass('active');
            });

            @if(session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if(session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>
    @stack('js')
</body>
</html>
