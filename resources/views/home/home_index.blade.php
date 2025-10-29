@extends('layouts.master')

@section('title', 'CoreSoft Digital - Profesyonel Yazılım Çözümleri')

@section('meta_description', 'CoreSoft Digital - Modern teknolojiler ve yenilikçi çözümler ile işinizi dijital dünyaya taşıyoruz. Web, mobil ve kurumsal yazılım geliştirme.')

@section('meta_keywords', 'yazılım geliştirme, web tasarım, mobil uygulama, e-ticaret, laravel, react, istanbul yazılım')

@section('styles')
<style>
    /* Hero Section */
    .hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        padding: 0 5%;
    }

    .hero-content {
        max-width: 1400px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
        z-index: 1;
    }

    .hero-text h1 {
        font-size: 4rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #fff 0%, #2563eb 50%, #7c3aed 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: fadeInUp 0.8s ease-out;
    }

    .hero-text p {
        font-size: 1.3rem;
        color: rgba(248, 250, 252, 0.8);
        margin-bottom: 2rem;
        line-height: 1.8;
        animation: fadeInUp 0.8s ease-out 0.2s backwards;
    }

    .cta-buttons {
        display: flex;
        gap: 1rem;
        animation: fadeInUp 0.8s ease-out 0.4s backwards;
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

    /* Hero Animation */
    .hero-animation {
        position: relative;
        animation: float 3s ease-in-out infinite;
    }

    .code-window {
        background: rgba(30, 41, 59, 0.8);
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }

    .window-header {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .window-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    .dot-red { background: #ff5f56; }
    .dot-yellow { background: #ffbd2e; }
    .dot-green { background: #27c93f; }

    .code-content {
        font-family: 'Courier New', monospace;
        font-size: 0.9rem;
        color: #a5b4fc;
    }

    .code-line {
        margin: 0.5rem 0;
        opacity: 0;
        animation: slideIn 0.5s ease-out forwards;
    }

    .code-line:nth-child(1) { animation-delay: 0.5s; }
    .code-line:nth-child(2) { animation-delay: 0.7s; }
    .code-line:nth-child(3) { animation-delay: 0.9s; }
    .code-line:nth-child(4) { animation-delay: 1.1s; }
    .code-line:nth-child(5) { animation-delay: 1.3s; }

    .keyword { color: #c678dd; }
    .function { color: #61afef; }
    .string { color: #98c379; }
    .comment { color: #5c6370; font-style: italic; }

    /* Why Choose Us Section */
    .why-choose-section {
        padding: 5rem 5%;
        position: relative;
        overflow: hidden;
    }

    .why-choose-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .feature-card {
        background: rgba(30, 41, 59, 0.5);
        padding: 2.5rem;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
        transition: all 0.5s ease;
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: conic-gradient(
            from 0deg at 50% 50%,
            transparent 0deg,
            rgba(37, 99, 235, 0.1) 90deg,
            transparent 180deg,
            rgba(124, 58, 237, 0.1) 270deg,
            transparent 360deg
        );
        animation: rotate 6s linear infinite;
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .feature-card:hover::before {
        opacity: 1;
    }

    @keyframes rotate {
        100% {
            transform: rotate(360deg);
        }
    }

    .feature-card:hover {
        transform: translateY(-15px) scale(1.02);
        border-color: var(--accent);
        box-shadow: 0 25px 50px rgba(6, 182, 212, 0.3);
    }

    .feature-icon-wrapper {
        width: 100px;
        height: 100px;
        margin: 0 auto 1.5rem;
        background: var(--gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        animation: float 3s ease-in-out infinite;
    }

    .feature-icon-wrapper::after {
        content: '';
        position: absolute;
        inset: -5px;
        border-radius: 50%;
        background: var(--gradient);
        opacity: 0.2;
        filter: blur(10px);
        z-index: -1;
    }

    .feature-icon {
        font-size: 2.5rem;
        color: white;
    }

    .feature-card h3 {
        font-size: 1.4rem;
        margin-bottom: 1rem;
        color: var(--light);
        position: relative;
        z-index: 1;
    }

    .feature-card p {
        color: rgba(248, 250, 252, 0.7);
        line-height: 1.8;
        font-size: 0.95rem;
        position: relative;
        z-index: 1;
    }

    .feature-badge {
        display: inline-block;
        padding: 0.4rem 1rem;
        background: rgba(6, 182, 212, 0.2);
        border: 1px solid var(--accent);
        border-radius: 20px;
        font-size: 0.8rem;
        color: var(--accent);
        font-weight: 600;
        margin-bottom: 1rem;
        animation: pulse 2s ease-in-out infinite;
    }

    /* Counter Animation */
    @keyframes countUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animated-text {
        animation: countUp 0.8s ease-out forwards;
    }

    /* Services Section */
    .services-section {
        padding: 5rem 5%;
    }

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

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .service-card {
        background: rgba(30, 41, 59, 0.5);
        padding: 2.5rem;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--gradient);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .service-card:hover::before {
        opacity: 0.1;
    }

    .service-card:hover {
        transform: translateY(-10px);
        border-color: var(--accent);
        box-shadow: 0 20px 40px rgba(6, 182, 212, 0.2);
    }

    .service-icon {
        font-size: 3rem;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .service-card h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }

    .service-card p {
        color: rgba(248, 250, 252, 0.7);
        line-height: 1.8;
        position: relative;
        z-index: 1;
    }

    /* Featured Projects */
    .projects-section {
        padding: 5rem 5%;
    }

    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .project-card {
        background: rgba(30, 41, 59, 0.5);
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .project-card:hover {
        transform: translateY(-10px);
        border-color: var(--accent);
        box-shadow: 0 20px 40px rgba(6, 182, 212, 0.2);
    }

    .project-image {
        height: 200px;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .project-image::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: repeating-linear-gradient(
            45deg,
            transparent,
            transparent 10px,
            rgba(255, 255, 255, 0.1) 10px,
            rgba(255, 255, 255, 0.1) 20px
        );
        animation: slide 20s linear infinite;
    }

    @keyframes slide {
        0% { transform: translate(0, 0); }
        100% { transform: translate(50%, 50%); }
    }

    .project-content {
        padding: 2rem;
    }

    .project-content h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .project-content p {
        color: rgba(248, 250, 252, 0.7);
        line-height: 1.8;
        margin-bottom: 1rem;
    }

    .project-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .tag {
        padding: 0.4rem 1rem;
        background: rgba(37, 99, 235, 0.2);
        border: 1px solid rgba(37, 99, 235, 0.5);
        border-radius: 20px;
        font-size: 0.85rem;
        color: var(--accent);
    }

    /* CTA Section */
    .cta-section {
        margin-bottom: 4rem;
        text-align: center;
    }

    .cta-content {
        max-width: 800px;
        margin: 0 auto;
        backdrop-filter: blur(10px);
    }

    .cta-content h2 {
        font-size: 2.5rem;
        font-weight: 800;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1rem;
    }

    .cta-content p {
        font-size: 1.2rem;
        color: rgba(248, 250, 252, 0.7);
        margin-bottom: 2rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-content {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .hero-text h1 {
            font-size: 2.5rem;
        }

        .cta-buttons {
            justify-content: center;
            flex-direction: column;
        }

        .hero-animation {
            display: none;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Geleceği Kodluyoruz</h1>
            <p>
                Dijital dönüşümünüzü gerçekleştirin. Modern teknolojiler ve yenilikçi çözümler ile
                işinizi bir üst seviyeye taşıyoruz.
            </p>
            <div class="cta-buttons">
                <a href="/projects" class="btn btn-primary">
                    <i class="fas fa-rocket"></i>
                    Projelerimizi İnceleyin
                </a>
                <a href="/contact" class="btn btn-secondary">
                    <i class="fas fa-comment"></i>
                    İletişime Geçin
                </a>
            </div>
        </div>
        <div class="hero-animation">
            <div class="code-window">
                <div class="window-header">
                    <div class="window-dot dot-red"></div>
                    <div class="window-dot dot-yellow"></div>
                    <div class="window-dot dot-green"></div>
                </div>
                <div class="code-content">
                    <div class="code-line">
                        <span class="keyword">class</span> <span class="function">CoreSoftDigital</span> {
                    </div>
                    <div class="code-line">
                        &nbsp;&nbsp;<span class="keyword">public function</span> <span class="function">innovate</span>() {
                    </div>
                    <div class="code-line">
                        &nbsp;&nbsp;&nbsp;&nbsp;<span class="keyword">return</span> <span class="string">'Excellence'</span>;
                    </div>
                    <div class="code-line">
                        &nbsp;&nbsp;}
                    </div>
                    <div class="code-line">
                        }
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="cta-content">
        <h2>Projenizi Hayata Geçirelim</h2>
        <p>
            Dijital dönüşüm yolculuğunuzda yanınızdayız. Projelerinizi görüşmek için
            bugün iletişime geçin.
        </p>
        <a href="/contact" class="btn btn-primary">
            <i class="fas fa-paper-plane"></i>
            Ücretsiz Teklif Alın
        </a>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-choose-section">
    <div class="why-choose-container">
        <div class="section-header">
            <h2>Neden CoreSoft Digital?</h2>
            <p>Dijital başarınız için güvenilir çözüm ortağınız</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <span class="feature-badge">7/24 Destek</span>
                <div class="feature-icon-wrapper">
                    <i class="fas fa-headset feature-icon"></i>
                </div>
                <h3>Sürekli Destek</h3>
                <p>
                    Proje teslimi sonrası da yanınızdayız. Teknik destek,
                    güncelleme ve bakım hizmetleri dahil.
                </p>
            </div>

            <div class="feature-card">
                <span class="feature-badge">Uygun Fiyat</span>
                <div class="feature-icon-wrapper">
                    <i class="fas fa-hand-holding-usd feature-icon"></i>
                </div>
                <h3>Şeffaf Fiyatlandırma</h3>
                <p>
                    Gizli maliyet yok! Net ve anlaşılır fiyatlandırma ile
                    bütçenize uygun paketler.
                </p>
            </div>

            <div class="feature-card">
                <span class="feature-badge">SEO Odaklı</span>
                <div class="feature-icon-wrapper">
                    <i class="fas fa-search feature-icon"></i>
                </div>
                <h3>Arama Motoru Uyumlu</h3>
                <p>
                    Google'da görünür olun! SEO optimizasyonu ile
                    organik trafiğinizi artırın.
                </p>
            </div>

            <div class="feature-card">
                <span class="feature-badge">Mobil Uyumlu</span>
                <div class="feature-icon-wrapper">
                    <i class="fas fa-mobile-alt feature-icon"></i>
                </div>
                <h3>Responsive Tasarım</h3>
                <p>
                    Tüm cihazlarda mükemmel görünüm. Mobil, tablet ve
                    masaüstü optimizasyonu garantili.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="section-header">
        <h2>Hizmetlerimiz</h2>
        <p>Kapsamlı ve profesyonel yazılım çözümleri</p>
    </div>
    <div class="services-grid">
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-laptop-code"></i>
            </div>
            <h3>Web Uygulamaları</h3>
            <p>
                Modern, responsive ve kullanıcı dostu web uygulamaları ile dijital varlığınızı güçlendirin.
                React, Vue.js ve Laravel ile geliştirilen yüksek performanslı çözümler.
            </p>
        </div>
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-mobile-alt"></i>
            </div>
            <h3>Mobil Uygulamalar</h3>
            <p>
                iOS ve Android platformları için native ve cross-platform mobil uygulamalar.
                Flutter ve React Native ile hızlı ve güvenilir çözümler.
            </p>
        </div>
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h3>E-Ticaret Çözümleri</h3>
            <p>
                Tam entegre e-ticaret platformları ile online satışlarınızı artırın.
                Ödeme sistemleri, stok yönetimi ve müşteri takibi dahil.
            </p>
        </div>
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-building"></i>
            </div>
            <h3>Kurumsal Yazılımlar</h3>
            <p>
                İşletmenize özel ERP, CRM ve iş yönetim sistemleri.
                Süreçlerinizi optimize edin ve verimliliği artırın.
            </p>
        </div>
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-cloud"></i>
            </div>
            <h3>Cloud Çözümleri</h3>
            <p>
                AWS, Azure ve Google Cloud platformlarında güvenli ve ölçeklenebilir
                bulut altyapısı kurulumu ve yönetimi.
            </p>
        </div>
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-robot"></i>
            </div>
            <h3>AI & Otomasyon</h3>
            <p>
                Yapay zeka destekli çözümler ve iş süreçleri otomasyonu ile
                rekabet avantajı elde edin.
            </p>
        </div>
    </div>
</section>

<!-- Featured Projects -->
<section class="projects-section">
    <div class="section-header">
        <h2>Öne Çıkan Projelerimiz</h2>
        <p>Son dönemde gerçekleştirdiğimiz başarılı projeler</p>
    </div>
    <div class="projects-grid">
        <div class="project-card">
            <div class="project-image">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="project-content">
                <h3>ModaMarket E-Ticaret Platformu</h3>
                <p>
                    Türkiye'nin önde gelen moda markalarından biri için geliştirdiğimiz
                    kapsamlı e-ticaret platformu. Günlük 50K+ ziyaretçi kapasiteli.
                </p>
                <div class="project-tags">
                    <span class="tag">Laravel</span>
                    <span class="tag">Vue.js</span>
                    <span class="tag">E-Ticaret</span>
                </div>
            </div>
        </div>
        <div class="project-card">
            <div class="project-image">
                <i class="fas fa-hospital"></i>
            </div>
            <div class="project-content">
                <h3>MediCare Hastane Yönetim Sistemi</h3>
                <p>
                    Özel hastaneler için geliştirilen entegre yönetim sistemi.
                    Hasta kayıtları, randevu sistemi ve stok yönetimi modülleri.
                </p>
                <div class="project-tags">
                    <span class="tag">PHP</span>
                    <span class="tag">MySQL</span>
                    <span class="tag">Kurumsal</span>
                </div>
            </div>
        </div>
        <div class="project-card">
            <div class="project-image">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="project-content">
                <h3>EduLearn Online Eğitim Platformu</h3>
                <p>
                    Canlı ders, video içerik ve interaktif sınav modülleri ile
                    tam özellikli online eğitim platformu.
                </p>
                <div class="project-tags">
                    <span class="tag">React</span>
                    <span class="tag">Node.js</span>
                    <span class="tag">WebRTC</span>
                </div>
            </div>
        </div>
    </div>
    <div style="text-align: center; margin-top: 3rem;">
        <a href="/projects" class="btn btn-primary">
            <i class="fas fa-eye"></i>
            Tüm Projeleri Görüntüle
        </a>
    </div>
</section>

@endsection
