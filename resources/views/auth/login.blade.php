<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - BNGU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #1a237e 0%, #283593 100%); }
        .auth-card { border: none; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); }
        .auth-card .card-header { background: #1a237e; color: #fff; font-weight: 600; border-radius: 12px 12px 0 0; padding: 1rem 1.5rem; }
        .btn-login { background: #1a237e; border: none; padding: 0.6rem 1.5rem; }
        .btn-login:hover { background: #283593; }
        .form-control:focus { border-color: #1a237e; box-shadow: 0 0 0 0.2rem rgba(26, 35, 126, 0.25); }
        .auth-link { color: #1a237e; text-decoration: none; }
        .auth-link:hover { text-decoration: underline; }
        .back-home { color: rgba(255,255,255,0.9); text-decoration: none; font-size: 0.9rem; }
        .back-home:hover { color: #fff; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <a href="{{ url('/') }}" class="back-home d-inline-block mb-3"><i class="fa-solid fa-arrow-left me-1"></i> Back to home</a>
                <div class="card auth-card">
                    <div class="card-header">
                        <i class="fa-solid fa-right-to-bracket me-2"></i> Login
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-login w-100">Login</button>
                        </form>
                        <p class="mt-3 mb-0 text-center">
                            Don't have an account? <a href="{{ route('register') }}" class="auth-link">Sign up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
