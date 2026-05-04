<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People Portal | Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --bg-grad: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-grad);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            width: 100%;
            max-width: 450px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: cardEnter 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes cardEnter {
            from { opacity: 0; transform: scale(0.9) translateY(30px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .logo-area {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background: var(--primary);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.5);
            margin-bottom: 16px;
        }

        .login-card h2 {
            font-family: 'Outfit', sans-serif;
            color: white;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .login-card p {
            color: #94a3b8;
            margin-bottom: 32px;
        }

        .form-label {
            color: #cbd5e1;
            font-weight: 500;
            font-size: 14px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 12px 16px;
            color: white;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.25);
            color: white;
        }

        .btn-login {
            background: var(--primary);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            color: white;
            width: 100%;
            margin-top: 16px;
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.4);
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
            border-radius: 12px 0 0 12px;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border-radius: 12px;
            font-size: 14px;
        }

        .portal-link {
            display: block;
            text-align: center;
            margin-top: 24px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }

        .portal-link:hover {
            color: white;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="logo-area">
            <div class="logo-icon">
                <i class="fas fa-fingerprint"></i>
            </div>
            <h2>People Portal</h2>
            <p>Access your digital services</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('people.login.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label">Login ID</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" name="login_id" class="form-control" placeholder="Enter your ID" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn btn-login">
                Sign In to Portal
            </button>
        </form>

        <a href="{{ url('/') }}" class="portal-link">
            <i class="fas fa-arrow-left me-2"></i> Back to Main Website
        </a>
    </div>

</body>
</html>
