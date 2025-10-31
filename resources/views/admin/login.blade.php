<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Giriş - CoreSoft Digital</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo/coresoftdigitalfavicon.png') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --secondary: #7c3aed;
            --accent: #06b6d4;
            --dark: #0f172a;
            --dark-light: #1e293b;
            --light: #f8fafc;
            --white: #ffffff;
            --danger: #ef4444;
            --gradient: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Background Animation */
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--dark);
            z-index: -1;
        }

        .background::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 100px,
                rgba(37, 99, 235, 0.03) 100px,
                rgba(37, 99, 235, 0.03) 200px
            );
            animation: slide 20s linear infinite;
        }

        @keyframes slide {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50%, 50%); }
        }

        /* Login Container */
        .login-container {
            width: 100%;
            max-width: 440px;
            padding: 2rem;
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Login Box */
        .login-box {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Logo */
        .login-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-logo img {
            height: 50px;
            width: auto;
            margin-bottom: 1rem;
        }

        .login-logo h1 {
            font-size: 1.75rem;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .login-logo p {
            color: rgba(248, 250, 252, 0.6);
            font-size: 0.95rem;
        }

        /* Form */
        .login-form {
            margin-top: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: var(--light);
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-input-wrapper {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            background: rgba(15, 23, 42, 0.5);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: var(--light);
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(15, 23, 42, 0.8);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .form-input::placeholder {
            color: rgba(248, 250, 252, 0.4);
        }

        .form-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(248, 250, 252, 0.4);
            font-size: 1.1rem;
        }

        .form-input:focus + .form-icon {
            color: var(--primary);
        }

        /* Remember & Forgot */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .form-checkbox {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(248, 250, 252, 0.7);
        }

        .form-checkbox input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .form-link {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .form-link:hover {
            color: var(--accent);
        }

        /* Submit Button */
        .btn-login {
            width: 100%;
            padding: 1rem;
            background: var(--gradient);
            color: var(--white);
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(37, 99, 235, 0.5);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Alert */
        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.9rem;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            color: #6ee7b7;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        /* Back to Home */
        .back-home {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .back-home a {
            color: rgba(248, 250, 252, 0.7);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-home a:hover {
            color: var(--accent);
        }

        /* Loading Spinner */
        .spinner {
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: var(--white);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            display: none;
        }

        .btn-login.loading .spinner {
            display: block;
        }

        .btn-login.loading .btn-text {
            display: none;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                padding: 1rem;
            }

            .login-box {
                padding: 2rem 1.5rem;
            }

            .login-logo h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <div class="login-container">
        <div class="login-box">
            <!-- Logo -->
            <div class="login-logo">
                <img src="{{ asset('images/logos/coresoftdigital-blank.png') }}" alt="CoreSoft Digital">
                <h1>Admin Paneli</h1>
                <p>Devam etmek için giriş yapın</p>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form class="login-form" method="POST" action="{{ route('login.post') }}" id="loginForm">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label" for="email">E-posta</label>
                    <div class="form-input-wrapper">
                        <input
                            type="email"
                            class="form-input"
                            id="email"
                            name="email"
                            placeholder="admin@coresoftdigital.com"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >
                        <i class="fas fa-envelope form-icon"></i>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="password">Şifre</label>
                    <div class="form-input-wrapper">
                        <input
                            type="password"
                            class="form-input"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required
                        >
                        <i class="fas fa-lock form-icon"></i>
                    </div>
                </div>

                <!-- Remember & Forgot -->
                <div class="form-options">
                    <label class="form-checkbox">
                        <input type="checkbox" name="remember" id="remember">
                        <span>Beni Hatırla</span>
                    </label>
                    <a href="#" class="form-link">Şifremi Unuttum?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login" id="loginBtn">
                    <div class="spinner"></div>
                    <span class="btn-text">
                        <i class="fas fa-sign-in-alt"></i>
                        Giriş Yap
                    </span>
                </button>
            </form>

            <!-- Back to Home -->
            <div class="back-home">
                <a href="{{ route('home') }}">
                    <i class="fas fa-arrow-left"></i>
                    Ana Sayfaya Dön
                </a>
            </div>
        </div>
    </div>

    <script>
        // Form Submit Loading
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            btn.classList.add('loading');
            btn.disabled = true;
        });

        // Enter key submit
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                document.getElementById('loginForm').submit();
            }
        });
    </script>
</body>
</html>
