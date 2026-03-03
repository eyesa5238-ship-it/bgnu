<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - BNGU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --admin-sidebar-bg: #1a237e;
            --admin-sidebar-width: 260px;
            --admin-header-height: 56px;
        }
        body { min-height: 100vh; background: #f0f2f5; }
        .admin-wrapper { display: flex; min-height: 100vh; }
        .admin-sidebar {
            width: var(--admin-sidebar-width);
            background: var(--admin-sidebar-bg);
            color: #fff;
            flex-shrink: 0;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            transition: width 0.2s, transform 0.2s;
        }
        .admin-sidebar-brand {
            padding: 1.25rem;
            font-weight: 700;
            font-size: 1.1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .admin-sidebar-brand i { font-size: 1.5rem; }
        .admin-nav { padding: 1rem 0; }
        .admin-nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1.25rem;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
        }
        .admin-nav-item:hover { background: rgba(255,255,255,0.1); color: #fff; }
        .admin-nav-item.active { background: rgba(255,255,255,0.15); color: #fff; }
        .admin-nav-item i { width: 1.25rem; text-align: center; }
        .admin-nav-divider { height: 1px; background: rgba(255,255,255,0.1); margin: 0.5rem 1.25rem; }
        .admin-main {
            flex: 1;
            margin-left: var(--admin-sidebar-width);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .admin-header {
            height: var(--admin-header-height);
            background: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .admin-header .breadcrumb { margin: 0; background: none; }
        .admin-header .breadcrumb-item a { color: #1a237e; text-decoration: none; }
        .admin-header-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .admin-header-user .dropdown-toggle { color: #333; }
        .admin-content { flex: 1; padding: 1.5rem; }
        .admin-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
        }
        .admin-card-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            font-size: 1rem;
        }
        .admin-card-body { padding: 1.25rem; }
        .admin-table { margin: 0; }
        .admin-table thead th {
            background: #f8f9fa;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            border-bottom: 1px solid #dee2e6;
            padding: 0.75rem 1rem;
        }
        .admin-table tbody td { padding: 0.75rem 1rem; vertical-align: middle; }
        .admin-table .btn-sm { padding: 0.25rem 0.5rem; font-size: 0.8rem; }
        .form-label { font-weight: 500; color: #495057; }
        .form-control:focus, .form-select:focus { border-color: #1a237e; box-shadow: 0 0 0 0.2rem rgba(26, 35, 126, 0.2); }
        .btn-admin-primary { background: #1a237e; color: #fff; border: none; }
        .btn-admin-primary:hover { background: #283593; color: #fff; }
        @media (max-width: 991.98px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-main { margin-left: 0; }
            .admin-sidebar.show { transform: translateX(0); }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="admin-sidebar-brand">
                <i class="fa-solid fa-graduation-cap"></i>
                BNGU Admin
            </div>
            <nav class="admin-nav">
                @if(auth()->user()->isAdmin())
                <a href="{{ route('faculty.index') }}" class="admin-nav-item {{ request()->routeIs('faculty.index') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                    Faculty
                </a>
                <a href="{{ route('education.index') }}" class="admin-nav-item {{ request()->routeIs('education.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-book"></i>
                    Education
                </a>
                @endif
                <a href="{{ route('profile.edit') }}" class="admin-nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-cog"></i>
                    Profile
                </a>
                <div class="admin-nav-divider"></div>
                <a href="{{ url('/') }}" class="admin-nav-item" target="_blank">
                    <i class="fa-solid fa-external-link-alt"></i>
                    View Site
                </a>
                <form action="{{ route('logout') }}" method="POST" class="p-0 m-0">
                    @csrf
                    <button type="submit" class="admin-nav-item w-100 border-0 bg-transparent text-start">
                        <i class="fa-solid fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </nav>
        </aside>

        <main class="admin-main">
            <header class="admin-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        @yield('breadcrumb')
                    </ol>
                </nav>
                <div class="admin-header-user">
                    <span class="text-muted small">{{ auth()->user()->name }}</span>
                    <span class="badge bg-primary rounded-pill">{{ auth()->user()->isAdmin() ? 'Admin' : 'Teacher' }}</span>
                </div>
            </header>

            <div class="admin-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
