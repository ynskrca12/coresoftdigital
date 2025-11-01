<style>
    /* Footer */
    footer {
        background: rgba(15, 23, 42, 0.95);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding: 3rem 5%;
        margin-top: 5rem;
    }

    .footer-content {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .footer-section h3 {
        margin-bottom: 1rem;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 1.3rem;
    }

    .footer-section p,
    .footer-section a {
        color: rgba(248, 250, 252, 0.7);
        text-decoration: none;
        display: block;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
        line-height: 1.8;
    }

    .footer-section a:hover {
        color: var(--accent);
        transform: translateX(5px);
    }

    .footer-section i {
        color: var(--accent);
    }

    .footer-logo {
        font-size: 1.5rem;
        font-weight: 800;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .footer-logo i {
        -webkit-text-fill-color: var(--primary);
    }

    .social-links {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .social-links a {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        transition: all 0.3s ease;
    }

    .social-links a:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.4);
    }

    .copyright {
        text-align: center;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(248, 250, 252, 0.5);
    }

    .copyright a {
        color: var(--accent);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .copyright a:hover {
        color: var(--primary);
    }

    /* Newsletter */
    .newsletter-form {
        display: flex;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .newsletter-input {
        flex: 1;
        padding: 0.8rem 1rem;
        background: rgba(15, 23, 42, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 25px;
        color: var(--light);
        font-family: 'Inter', sans-serif;
        transition: all 0.3s ease;
    }

    .newsletter-input:focus {
        outline: none;
        border-color: var(--accent);
        background: rgba(15, 23, 42, 0.7);
    }

    .newsletter-btn {
        padding: 0.8rem 1.5rem;
        background: var(--gradient);
        border: none;
        border-radius: 25px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .newsletter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(37, 99, 235, 0.4);
    }
     .logo-text {
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .footer-logo img {
        height: 45px;
        width: auto;
        transition: all 0.3s ease;
    }
    .footer-logo:hover img {
        filter: drop-shadow(0 0 10px rgba(37, 99, 235, 0.5));
    }


    /* Responsive */
    @media (max-width: 768px) {
        .footer-content {
            grid-template-columns: 1fr;
        }

        .newsletter-form {
            flex-direction: column;
        }

        .newsletter-btn {
            width: 100%;
        }
        .logo-text {
            font-size: 1.2rem;
        }
        .footer-logo img {
            height: 35px;
        }
    }
</style>

<footer>
    <div class="footer-content">
        <!-- Company Info -->
        <div class="footer-section">
            <div class="footer-logo">
                <img src="{{ asset('images/logos/coresoftdigital-blank2.png') }}" alt="CoreSoft Digital Logo">
                <span class="logo-text">CoreSoft Digital</span>
            </div>
            <p>
                Profesyonel yazılım çözümleri ile işinizi dijital dünyaya taşıyoruz.
                Modern teknolojiler ve yenilikçi yaklaşımlarla yanınızdayız.
            </p>
            <div class="social-links">
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="https://x.com/coresoftdigital"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com/coresoftdigital/"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <!-- Services -->
        <div class="footer-section">
            <h3>Hizmetlerimiz</h3>
            <a href="{{ route('projects') }}">Web Uygulamaları</a>
            <a href="{{ route('projects') }}">Mobil Uygulamalar</a>
            <a href="{{ route('projects') }}">E-Ticaret Çözümleri</a>
            <a href="{{ route('projects') }}">Kurumsal Yazılımlar</a>
            <a href="{{ route('projects') }}">Cloud Çözümleri</a>
            <a href="{{ route('projects') }}">AI & Otomasyon</a>
        </div>

        <!-- Company -->
        <div class="footer-section">
            <h3>Şirket</h3>
            <a href="{{ route('about') }}">Hakkımızda</a>
            <a href="{{ route('projects') }}">Projelerimiz</a>
            <a href="{{ route('blog') }}">Blog</a>
            <a href="{{ route('contact') }}">İletişim</a>
        </div>

        <!-- Contact & Newsletter -->
        <div class="footer-section">
            <h3>İletişim</h3>
            <p><i class="fas fa-envelope"></i> info@coresoftdigital.com</p>
            <p><i class="fas fa-phone"></i> +90 (534 234 64 81) / +90 (539 314 19 74)</p>
            <p><i class="fas fa-map-marker-alt"></i> Pendik, İstanbul, TR</p>

            <p class="mt-4">Yeniliklerden haberdar olun</p>
            <form class="newsletter-form" onsubmit="event.preventDefault(); alert('Teşekkürler! E-bültenimize kaydoldunuz.');">
                <input type="email" class="newsletter-input" placeholder="E-posta adresiniz" required>
                <button type="submit" class="newsletter-btn">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="copyright">
        <p>
            &copy; {{ date('Y') }} <a href="{{ route('home') }}">CoreSoft Digital</a>. Tüm hakları saklıdır.
            | <a href="#">Gizlilik Politikası</a> | <a href="#">Kullanım Koşulları</a>
        </p>
        <p style="margin-top: 0.5rem; font-size: 0.9rem;">
            Made with <i class="fas fa-heart" style="color: #ef4444;"></i> in Istanbul
        </p>
    </div>
</footer>
