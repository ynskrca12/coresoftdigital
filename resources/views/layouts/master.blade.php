<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'CoreSoft Digital - Profesyonel yazılım çözümleri ile işinizi dijital dünyaya taşıyoruz.')">
    <meta name="keywords" content="@yield('meta_keywords', 'yazılım, web geliştirme, mobil uygulama, e-ticaret, laravel')">
    <meta name="author" content="CoreSoft Digital">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'CoreSoft Digital - Profesyonel Yazılım Çözümleri')">
    <meta property="og:description" content="@yield('meta_description', 'CoreSoft Digital - Profesyonel yazılım çözümleri ile işinizi dijital dünyaya taşıyoruz.')">
    <meta property="og:image" content="{{ asset('images/logo/coresoftdigitalfavicon-bg-remove.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'CoreSoft Digital - Profesyonel Yazılım Çözümleri')">
    <meta property="twitter:description" content="@yield('meta_description', 'CoreSoft Digital - Profesyonel yazılım çözümleri ile işinizi dijital dünyaya taşıyoruz.')">
    <meta property="twitter:image" content="{{ asset('images/logo/coresoftdigitalfavicon.png') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo/coresoftdigitalfavicon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo/coresoftdigitalfavicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/coresoftdigitalfavicon.png') }}">

    <title>@yield('title', 'CoreSoft Digital - Profesyonel Yazılım Çözümleri')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Base Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2563eb;
            --secondary: #7c3aed;
            --accent: #06b6d4;
            --dark: #0f172a;
            --light: #f8fafc;
            --gradient: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark);
            color: var(--light);
            overflow-x: hidden;
        }

        /* Main Content */
        main {
            margin-top: 80px;
            min-height: calc(100vh - 80px);
        }

        /* Particles Background */
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
        }

        /* Common Animations */
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

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slide {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50%, 50%); }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .float {
            animation: float 3s ease-in-out infinite;
        }

        /* Common Components */
        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            font-size: 3rem;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }

        .section-header p {
            font-size: 1.2rem;
            color: rgba(248, 250, 252, 0.7);
            max-width: 600px;
            margin: 0 auto;
        }

        .btn {
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary {
            background: var(--gradient);
            color: white;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(37, 99, 235, 0.6);
        }

        .btn-secondary {
            background: transparent;
            color: var(--light);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .btn-secondary:hover {
            border-color: var(--accent);
            background: rgba(6, 182, 212, 0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            main {
                margin-top: 70px;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .section-header p {
                font-size: 1rem;
            }
        }
    </style>

    @yield('styles')
</head>
<body>
    <!-- Page Loader -->
    @include('layouts.loader')

    <!-- Particles Background -->
    <div id="particles-js"></div>

    <!-- Header -->
    @include('layouts.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

    <!-- Base Scripts -->
    <script>
        // Particles.js configuration
        particlesJS('particles-js', {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: '#2563eb' },
                shape: { type: 'circle' },
                opacity: { value: 0.5, random: false },
                size: { value: 3, random: true },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#2563eb',
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 2,
                    direction: 'none',
                    random: false,
                    straight: false,
                    out_mode: 'out',
                    bounce: false
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: { enable: true, mode: 'repulse' },
                    onclick: { enable: true, mode: 'push' },
                    resize: true
                }
            },
            retina_detect: true
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const navLinks = document.getElementById('nav-links');

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                navLinks.classList.toggle('active');
                mobileMenuBtn.classList.toggle('active');
            });
        }
    </script>

    @yield('scripts')
</body>
</html>
