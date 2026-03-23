<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Profile') - BNGU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --brand: #1a237e; }
        body { background: #f6f7fb; }
        .brand-bg { background: var(--brand); }
        .section-card {
            background: #fff;
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(16, 24, 40, 0.06);
        }
        .section-title {
            font-weight: 700;
            font-size: 1.05rem;
            margin: 0;
        }
        .profile-hero {
            background: linear-gradient(135deg, rgba(26,35,126,1) 0%, rgba(63,81,181,1) 50%, rgba(13,71,161,1) 100%);
            color: #fff;
        }
        .avatar {
            width: 140px;
            height: 140px;
            border-radius: 999px;
            overflow: hidden;
            border: 4px solid rgba(255,255,255,0.35);
            background: rgba(255,255,255,0.12);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .avatar img { width: 100%; height: 100%; object-fit: cover; }
        .toc a {
            text-decoration: none;
            color: #111827;
        }
        .toc a:hover { color: var(--brand); }
        .toc .list-group-item { border: 0; border-bottom: 1px solid rgba(0,0,0,0.06); }
        .muted { color: rgba(255,255,255,0.85); }
        .empty {
            border: 1px dashed rgba(0,0,0,0.2);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            color: #6b7280;
            background: #fafafa;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark brand-bg">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ url('/') }}">BNGU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        @if(auth()->user()->canAccessAdminPanel())
                            <li class="nav-item"><a class="nav-link" href="{{ route('faculty.index') }}">Admin</a></li>
                        @endif
                        <li class="nav-item"><span class="nav-link">{{ auth()->user()->name }}</span></li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button class="btn btn-link nav-link p-0" type="submit">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Sign Up</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

