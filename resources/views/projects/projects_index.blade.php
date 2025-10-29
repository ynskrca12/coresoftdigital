@extends('layouts.master')

@section('title', 'Projelerimiz - CoreSoft Digital')

@section('meta_description', 'CoreSoft Digital tarafından gerçekleştirilen başarılı projeler. Web, mobil, e-ticaret ve kurumsal yazılım projeleri.')

@section('meta_keywords', 'yazılım projeleri, web projeleri, mobil uygulama projeleri, e-ticaret, portfolio')

@section('styles')
<style>
    .projects-hero {
        padding: 8rem 5% 5rem;
        text-align: center;
    }

    .projects-hero h1 {
        font-size: 4rem;
        font-weight: 800;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1.5rem;
        animation: fadeInUp 0.8s ease-out;
    }

    .projects-hero p {
        font-size: 1.5rem;
        color: rgba(248, 250, 252, 0.7);
        max-width: 800px;
        margin: 0 auto 2rem;
        animation: fadeInUp 0.8s ease-out 0.2s backwards;
    }

    .filter-tabs {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        animation: fadeInUp 0.8s ease-out 0.4s backwards;
    }

    .filter-btn {
        padding: 0.8rem 2rem;
        border-radius: 50px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        background: transparent;
        color: var(--light);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-btn:hover,
    .filter-btn.active {
        border-color: var(--accent);
        background: rgba(6, 182, 212, 0.1);
        color: var(--accent);
    }

    .projects-container {
        padding: 5rem 5%;
    }

    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 2.5rem;
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
        cursor: pointer;
    }

    .project-card:hover {
        transform: translateY(-10px);
        border-color: var(--accent);
        box-shadow: 0 20px 40px rgba(6, 182, 212, 0.3);
    }

    .project-image {
        height: 240px;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 5rem;
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
            rgba(255, 255, 255, 0.05) 10px,
            rgba(255, 255, 255, 0.05) 20px
        );
        animation: slide 25s linear infinite;
    }

    .project-image i {
        position: relative;
        z-index: 1;
    }

    .project-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.5rem 1rem;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        z-index: 2;
    }

    .badge-featured {
        background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
    }

    .badge-new {
        background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
    }

    .project-content {
        padding: 2rem;
    }

    .project-category {
        color: var(--accent);
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }

    .project-content h3 {
        font-size: 1.6rem;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .project-description {
        color: rgba(248, 250, 252, 0.7);
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .project-stats {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(248, 250, 252, 0.6);
        font-size: 0.9rem;
    }

    .stat-item i {
        color: var(--accent);
    }

    .project-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .tag {
        padding: 0.4rem 1rem;
        background: rgba(37, 99, 235, 0.2);
        border: 1px solid rgba(37, 99, 235, 0.5);
        border-radius: 20px;
        font-size: 0.85rem;
        color: var(--accent);
    }

    .project-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .client-info {
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .client-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
    }

    .client-name {
        font-size: 0.9rem;
        color: rgba(248, 250, 252, 0.7);
    }

    .view-btn {
        padding: 0.6rem 1.5rem;
        background: var(--gradient);
        color: white;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .view-btn:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(37, 99, 235, 0.4);
    }

    .load-more {
        text-align: center;
        margin-top: 4rem;
    }

    /* Why Work With Us Section */
    .why-section {
        padding: 5rem 5%;
        position: relative;
        overflow: hidden;
    }

    .why-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 30% 50%, rgba(37, 99, 235, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .why-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        max-width: 1400px;
        margin: 3rem auto 0;
    }

    .why-card {
        background: rgba(30, 41, 59, 0.5);
        padding: 2.5rem;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .why-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--gradient);
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .why-card:hover::before {
        transform: scaleX(1);
    }

    .why-card:hover {
        transform: translateY(-10px);
        border-color: var(--accent);
        box-shadow: 0 20px 40px rgba(6, 182, 212, 0.25);
    }

    .why-icon-box {
        width: 80px;
        height: 80px;
        background: var(--gradient);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        position: relative;
        animation: float 3s ease-in-out infinite;
    }

    .why-icon-box::after {
        content: '';
        position: absolute;
        inset: -5px;
        background: var(--gradient);
        border-radius: 20px;
        opacity: 0.3;
        filter: blur(15px);
        z-index: -1;
    }

    .why-icon-box i {
        font-size: 2.5rem;
        color: white;
    }

    .why-card h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--light);
    }

    .why-card p {
        color: rgba(248, 250, 252, 0.8);
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .why-list {
        list-style: none;
        padding: 0;
    }

    .why-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.8rem;
        color: rgba(248, 250, 252, 0.7);
        margin-bottom: 0.8rem;
        font-size: 0.95rem;
    }

    .why-list li i {
        color: var(--accent);
        margin-top: 0.2rem;
        flex-shrink: 0;
    }

    /* Process Section */
    .process-section {
        padding: 5rem 5%;
    }

    .process-container {
        max-width: 1200px;
        margin: 3rem auto 0;
    }

    .process-steps {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        position: relative;
    }

    .process-step {
        text-align: center;
        position: relative;
    }

    .step-number {
        width: 70px;
        height: 70px;
        background: var(--gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        font-weight: 800;
        color: white;
        position: relative;
        z-index: 1;
    }

    .step-number::after {
        content: '';
        position: absolute;
        inset: -5px;
        background: var(--gradient);
        border-radius: 50%;
        opacity: 0.3;
        filter: blur(10px);
        z-index: -1;
    }

    .process-step h4 {
        font-size: 1.3rem;
        margin-bottom: 1rem;
        color: var(--light);
    }

    .process-step p {
        color: rgba(248, 250, 252, 0.7);
        line-height: 1.6;
    }

    /* CTA Section */
    .project-cta {
        padding: 5rem 5%;
        background: rgba(30, 41, 59, 0.3);
    }

    .cta-container {
        max-width: 900px;
        margin: 0 auto;
        background: var(--gradient);
        padding: 4rem 3rem;
        border-radius: 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: repeating-linear-gradient(
            45deg,
            transparent,
            transparent 20px,
            rgba(255, 255, 255, 0.05) 20px,
            rgba(255, 255, 255, 0.05) 40px
        );
        animation: slide 20s linear infinite;
    }

    .cta-container h2 {
        font-size: 2.5rem;
        color: white;
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }

    .cta-container p {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 2rem;
        position: relative;
        z-index: 1;
    }

    .cta-btn {
        background: white;
        color: var(--primary);
        padding: 1.2rem 3rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
        font-size: 1.1rem;
    }

    .cta-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 768px) {
        .projects-hero h1 {
            font-size: 2.5rem;
        }

        .projects-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero -->
<section class="projects-hero">
    <h1>Projelerimiz</h1>
    <p>
        Gerçekleştirdiğimiz başarılı projelerle müşterilerimizin dijital dönüşüm yolculuğunda
        yanlarında olduk.
    </p>
    <div class="filter-tabs">
        <button class="filter-btn active" data-filter="all">Tümü</button>
        <button class="filter-btn" data-filter="web">Web Uygulamaları</button>
        <button class="filter-btn" data-filter="mobile">Mobil Uygulamalar</button>
        <button class="filter-btn" data-filter="ecommerce">E-Ticaret</button>
        <button class="filter-btn" data-filter="enterprise">Kurumsal</button>
    </div>
</section>

<!-- Projects Grid -->
<section class="projects-container">
    <div class="projects-grid">
        <!-- Project 1 -->
        <div class="project-card" data-category="ecommerce">
            <div class="project-image">
                <span class="project-badge badge-featured">Öne Çıkan</span>
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="project-content">
                <div class="project-category">E-Ticaret</div>
                <h3>ModaMarket E-Ticaret Platformu</h3>
                <p class="project-description">
                    Türkiye'nin lider moda markalarından biri için geliştirdiğimiz tam entegre
                    e-ticaret platformu. Günlük 50K+ ziyaretçi kapasiteli, gelişmiş ürün yönetimi
                    ve ödeme altyapısı.
                </p>
                <div class="project-stats">
                    <div class="stat-item">
                        <i class="fas fa-calendar"></i>
                        <span>2024</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-clock"></i>
                        <span>6 Ay</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-users"></i>
                        <span>8 Kişi</span>
                    </div>
                </div>
                <div class="project-tags">
                    <span class="tag">Laravel</span>
                    <span class="tag">Vue.js</span>
                    <span class="tag">MySQL</span>
                    <span class="tag">Redis</span>
                </div>
                <div class="project-footer">
                    <div class="client-info">
                        <div class="client-avatar">MM</div>
                        <div class="client-name">ModaMarket</div>
                    </div>
                    <a href="#" class="view-btn">
                        Detaylar
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Project 2 -->
        <div class="project-card" data-category="enterprise">
            <div class="project-image">
                <i class="fas fa-hospital"></i>
            </div>
            <div class="project-content">
                <div class="project-category">Kurumsal Yazılım</div>
                <h3>MediCare Hastane Yönetim Sistemi</h3>
                <p class="project-description">
                    Kapsamlı hastane yönetim sistemi. Hasta kayıtları, randevu sistemi, elektronik
                    reçete, stok yönetimi ve muhasebe modülleri içeren entegre çözüm.
                </p>
                <div class="project-stats">
                    <div class="stat-item">
                        <i class="fas fa-calendar"></i>
                        <span>2023</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-clock"></i>
                        <span>8 Ay</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-users"></i>
                        <span>10 Kişi</span>
                    </div>
                </div>
                <div class="project-tags">
                    <span class="tag">PHP</span>
                    <span class="tag">MySQL</span>
                    <span class="tag">Bootstrap</span>
                    <span class="tag">API</span>
                </div>
                <div class="project-footer">
                    <div class="client-info">
                        <div class="client-avatar">MC</div>
                        <div class="client-name">MediCare</div>
                    </div>
                    <a href="#" class="view-btn">
                        Detaylar
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Project 3 -->
        <div class="project-card" data-category="web">
            <div class="project-image">
                <span class="project-badge badge-new">Yeni</span>
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="project-content">
                <div class="project-category">Eğitim Platformu</div>
                <h3>EduLearn Online Eğitim Platformu</h3>
                <p class="project-description">
                    Canlı ders, video içerik, interaktif sınav ve ödev sistemi içeren tam özellikli
                    online eğitim platformu. WebRTC ile gerçek zamanlı iletişim.
                </p>
                <div class="project-stats">
                    <div class="stat-item">
                        <i class="fas fa-calendar"></i>
                        <span>2025</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-clock"></i>
                        <span>5 Ay</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-users"></i>
                        <span>6 Kişi</span>
                    </div>
                </div>
                <div class="project-tags">
                    <span class="tag">React</span>
                    <span class="tag">Node.js</span>
                    <span class="tag">MongoDB</span>
                    <span class="tag">WebRTC</span>
                </div>
                <div class="project-footer">
                    <div class="client-info">
                        <div class="client-avatar">EL</div>
                        <div class="client-name">EduLearn</div>
                    </div>
                    <a href="#" class="view-btn">
                        Detaylar
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Project 4 -->
        <div class="project-card" data-category="mobile">
            <div class="project-image">
                <i class="fas fa-mobile-alt"></i>
            </div>
            <div class="project-content">
                <div class="project-category">Mobil Uygulama</div>
                <h3>FitLife Sağlık & Fitness Uygulaması</h3>
                <p class="project-description">
                    Kişiselleştirilmiş antrenman programları, beslenme takibi ve ilerleme analizi
                    sunan iOS ve Android uygulaması. Giyilebilir cihaz entegrasyonu.
                </p>
                <div class="project-stats">
                    <div class="stat-item">
                        <i class="fas fa-calendar"></i>
                        <span>2024</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-clock"></i>
                        <span>4 Ay</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-users"></i>
                        <span>5 Kişi</span>
                    </div>
                </div>
                <div class="project-tags">
                    <span class="tag">Flutter</span>
                    <span class="tag">Firebase</span>
                    <span class="tag">AI/ML</span>
                </div>
                <div class="project-footer">
                    <div class="client-info">
                        <div class="client-avatar">FL</div>
                        <div class="client-name">FitLife</div>
                    </div>
                    <a href="#" class="view-btn">
                        Detaylar
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Project 5 -->
        <div class="project-card" data-category="enterprise">
            <div class="project-image">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="project-content">
                <div class="project-category">CRM Sistemi</div>
                <h3>SalesPro Müşteri İlişkileri Yönetimi</h3>
                <p class="project-description">
                    Satış ekipleri için geliştirilmiş kapsamlı CRM sistemi. Lead yönetimi,
                    satış hunisi, raporlama ve tahminleme modülleri.
                </p>
                <div class="project-stats">
                    <div class="stat-item">
                        <i class="fas fa-calendar"></i>
                        <span>2024</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-clock"></i>
                        <span>7 Ay</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-users"></i>
                        <span>9 Kişi</span>
                    </div>
                </div>
                <div class="project-tags">
                    <span class="tag">Laravel</span>
                    <span class="tag">Vue.js</span>
                    <span class="tag">PostgreSQL</span>
                </div>
                <div class="project-footer">
                    <div class="client-info">
                        <div class="client-avatar">SP</div>
                        <div class="client-name">SalesPro</div>
                    </div>
                    <a href="#" class="view-btn">
                        Detaylar
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Project 6 -->
        <div class="project-card" data-category="web">
            <div class="project-image">
                <i class="fas fa-utensils"></i>
            </div>
            <div class="project-content">
                <div class="project-category">Yemek Sipariş</div>
                <h3>TastyFood Online Yemek Siparişi</h3>
                <p class="project-description">
                    Restoran ve müşteriler için online sipariş platformu. Gerçek zamanlı takip,
                    ödeme entegrasyonu ve restoran yönetim paneli.
                </p>
                <div class="project-stats">
                    <div class="stat-item">
                        <i class="fas fa-calendar"></i>
                        <span>2023</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-clock"></i>
                        <span>5 Ay</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-users"></i>
                        <span>7 Kişi</span>
                    </div>
                </div>
                <div class="project-tags">
                    <span class="tag">React</span>
                    <span class="tag">Express</span>
                    <span class="tag">MongoDB</span>
                    <span class="tag">Socket.io</span>
                </div>
                <div class="project-footer">
                    <div class="client-info">
                        <div class="client-avatar">TF</div>
                        <div class="client-name">TastyFood</div>
                    </div>
                    <a href="#" class="view-btn">
                        Detaylar
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="load-more">
        <button class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Daha Fazla Yükle
        </button>
    </div>
</section>

<!-- Why Work With Us Section -->
<section class="why-section">
    <div class="section-header">
        <h2>Neden Bizimle Çalışmalısınız?</h2>
        <p>Projenizi doğru ekibe teslim edin</p>
    </div>
    <div class="why-grid">
        <div class="why-card">
            <div class="why-icon-box">
                <i class="fas fa-bolt"></i>
            </div>
            <h3>Hızlı Teslimat</h3>
            <p>
                Küçük ekip yapımız sayesinde hızlı karar alır ve projeleri zamanında teslim ederiz.
            </p>
            <ul class="why-list">
                <li><i class="fas fa-check-circle"></i> Prototip 1-2 haftada hazır</li>
                <li><i class="fas fa-check-circle"></i> Agile metodoloji ile iteratif geliştirme</li>
                <li><i class="fas fa-check-circle"></i> Günlük ilerleme raporları</li>
            </ul>
        </div>

        <div class="why-card">
            <div class="why-icon-box">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <h3>Uygun Maliyetli</h3>
            <p>
                Büyük ajansların yüksek fiyatları yerine, kaliteli ve uygun maliyetli çözümler sunuyoruz.
            </p>
            <ul class="why-list">
                <li><i class="fas fa-check-circle"></i> Gizli ücret yok</li>
                <li><i class="fas fa-check-circle"></i> Esnek ödeme planları</li>
                <li><i class="fas fa-check-circle"></i> Bakım ve destek dahil</li>
            </ul>
        </div>

        <div class="why-card">
            <div class="why-icon-box">
                <i class="fas fa-code"></i>
            </div>
            <h3>Modern Teknolojiler</h3>
            <p>
                En güncel frameworkler ve best practice'ler ile temiz, sürdürülebilir kod yazıyoruz.
            </p>
            <ul class="why-list">
                <li><i class="fas fa-check-circle"></i> React, Vue.js, Laravel</li>
                <li><i class="fas fa-check-circle"></i> Cloud-ready mimariler</li>
                <li><i class="fas fa-check-circle"></i> Responsive ve mobil uyumlu</li>
            </ul>
        </div>

        <div class="why-card">
            <div class="why-icon-box">
                <i class="fas fa-comments"></i>
            </div>
            <h3>Şeffaf İletişim</h3>
            <p>
                Projenizin her aşamasında yanınızdayız. Sorularınıza hızlı yanıt, açık iletişim.
            </p>
            <ul class="why-list">
                <li><i class="fas fa-check-circle"></i> Dedicated project manager</li>
                <li><i class="fas fa-check-circle"></i> Haftalık demo toplantıları</li>
                <li><i class="fas fa-check-circle"></i> WhatsApp/Slack desteği</li>
            </ul>
        </div>

        <div class="why-card">
            <div class="why-icon-box">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3>Güvenilir Destek</h3>
            <p>
                Proje tesliminden sonra da yanınızdayız. Teknik destek, güncelleme ve bakım hizmetleri.
            </p>
            <ul class="why-list">
                <li><i class="fas fa-check-circle"></i> 3 ay ücretsiz destek</li>
                <li><i class="fas fa-check-circle"></i> Bug fix garantisi</li>
                <li><i class="fas fa-check-circle"></i> Dokümantasyon ve eğitim</li>
            </ul>
        </div>

        <div class="why-card">
            <div class="why-icon-box">
                <i class="fas fa-rocket"></i>
            </div>
            <h3>SEO & Performans</h3>
            <p>
                Sadece güzel değil, hızlı ve Google'da görünür projeler geliştiriyoruz.
            </p>
            <ul class="why-list">
                <li><i class="fas fa-check-circle"></i> SEO optimizasyonu dahil</li>
                <li><i class="fas fa-check-circle"></i> PageSpeed 90+ skor</li>
                <li><i class="fas fa-check-circle"></i> Core Web Vitals optimize</li>
            </ul>
        </div>
    </div>
</section>

<!-- Our Process -->
<section class="process-section">
    <div class="section-header">
        <h2>Çalışma Sürecimiz</h2>
        <p>Baştan sona şeffaf ve organize</p>
    </div>
    <div class="process-container">
        <div class="process-steps">
            <div class="process-step">
                <div class="step-number">1</div>
                <h4>Keşif & Analiz</h4>
                <p>
                    İhtiyaçlarınızı dinliyor, hedeflerinizi anlıyor ve en uygun
                    çözümü birlikte tasarlıyoruz.
                </p>
            </div>
            <div class="process-step">
                <div class="step-number">2</div>
                <h4>Tasarım & Onay</h4>
                <p>
                    UI/UX tasarımları hazırlıyor, sizin onayınızı alıyor ve
                    gerekli revizyonları yapıyoruz.
                </p>
            </div>
            <div class="process-step">
                <div class="step-number">3</div>
                <h4>Geliştirme</h4>
                <p>
                    Agile metodoloji ile sprint'ler halinde kodluyoruz. Her sprint
                    sonunda size demo sunuyoruz.
                </p>
            </div>
            <div class="process-step">
                <div class="step-number">4</div>
                <h4>Test & Teslim</h4>
                <p>
                    Kapsamlı testlerden geçiriyor, performans optimizasyonu
                    yapıyor ve projeyi teslim ediyoruz.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="project-cta">
    <div class="cta-container">
        <h2>Projeniz Hazır mı?</h2>
        <p>
            Hayalinizdeki projeyi birlikte gerçekleştirelim. Ücretsiz danışmanlık için
            hemen iletişime geçin!
        </p>
        <a href="{{ route('contact') }}" class="cta-btn">
            <i class="fas fa-paper-plane"></i>
            Ücretsiz Teklif Alın
        </a>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.dataset.filter;

            // Filter projects
            projectCards.forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'scale(1)';
                    }, 10);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
</script>
@endsection
