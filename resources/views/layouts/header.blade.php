<style>
    /* Navigation */
    nav {
        position: fixed;
        top: 0;
        width: 100%;
        padding: 1.5rem 5%;
        background: rgba(15, 23, 42, 0.95);
        backdrop-filter: blur(10px);
        z-index: 1000;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    nav.scrolled {
        padding: 1rem 5%;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .nav-container {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 1.8rem;
        font-weight: 800;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        transition: all 0.3s ease;
    }

    .logo img {
        height: 35px;
        width: auto;
        transition: all 0.3s ease;
    }

    .logo-text {
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .logo:hover {
        transform: scale(1.05);
    }

    .logo:hover img {
        filter: drop-shadow(0 0 10px rgba(37, 99, 235, 0.5));
    }

    .nav-links {
        display: flex;
        gap: 2.5rem;
        list-style: none;
    }

    .nav-links a {
        color: var(--light);
        text-decoration: none;
        font-weight: 500;
        position: relative;
        transition: color 0.3s ease;
        font-size: 1rem;
    }

    .nav-links a::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--gradient);
        transition: width 0.3s ease;
    }

    .nav-links a:hover::after,
    .nav-links a.active::after {
        width: 100%;
    }

    .nav-links a:hover,
    .nav-links a.active {
        color: var(--accent);
    }

    /* Mobile Menu Button */
    .mobile-menu-btn {
        display: none;
        flex-direction: column;
        gap: 5px;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 5px;
    }

    .mobile-menu-btn span {
        width: 25px;
        height: 3px;
        background: var(--light);
        border-radius: 3px;
        transition: all 0.3s ease;
    }

    .mobile-menu-btn.active span:nth-child(1) {
        transform: rotate(45deg) translate(8px, 8px);
    }

    .mobile-menu-btn.active span:nth-child(2) {
        opacity: 0;
    }

    .mobile-menu-btn.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .nav-links {
            position: fixed;
            top: 70px;
            right: -100%;
            width: 70%;
            height: calc(100vh - 70px);
            background: rgba(15, 23, 42, 0.98);
            backdrop-filter: blur(20px);
            flex-direction: column;
            padding: 2rem;
            gap: 1.5rem;
            transition: right 0.3s ease;
            border-left: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-links.active {
            right: 0;
        }

        .nav-links a {
            font-size: 1.2rem;
            padding: 0.5rem 0;
        }

        .mobile-menu-btn {
            display: flex;
        }

        .logo {
            font-size: 1.4rem;
        }

        .logo img {
            height: 35px;
        }

        .logo-text {
            font-size: 1.2rem;
        }
    }
</style>

<nav id="navbar">
    <div class="nav-container">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/logos/coresoftdigital-blank2.png') }}" alt="CoreSoft Digital Logo">
            <span class="logo-text">CoreSoft Digital</span>
        </a>

        <ul class="nav-links" id="nav-links">
            <li><a href="{{ route('home') }}" class="{{ Request::routeIs('home') ? 'active' : '' }}">Ana Sayfa</a></li>
            <li><a href="{{ route('about') }}" class="{{ Request::routeIs('about') ? 'active' : '' }}">Hakkımızda</a></li>
            <li><a href="{{ route('projects') }}" class="{{ Request::routeIs('projects') ? 'active' : '' }}">Projelerimiz</a></li>
            <li><a href="{{ route('blog') }}" class="{{ Request::routeIs('blogs') ? 'active' : '' }}">Blog</a></li>
            <li><a href="{{ route('contact') }}" class="{{ Request::routeIs('contact') ? 'active' : '' }}">İletişim</a></li>
        </ul>

        <button class="mobile-menu-btn" id="mobile-menu-btn" aria-label="Menü">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>
