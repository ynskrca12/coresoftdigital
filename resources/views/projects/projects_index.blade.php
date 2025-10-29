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

    .stats-section {
        padding: 5rem 5%;
        background: rgba(30, 41, 59, 0.3);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 3rem auto 0;
    }

    .stat-card {
        text-align: center;
        padding: 2rem;
        background: rgba(30, 41, 59, 0.5);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        border-color: var(--accent);
    }

    .stat-card i {
        font-size: 2.5rem;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1rem;
    }

    .stat-card h4 {
        font-size: 2.5rem;
        font-weight: 800;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
    }

    .stat-card p {
        color: rgba(248, 250, 252, 0.7);
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

<!-- Stats Section -->
<section class="stats-section">
    <div class="section-header">
        <h2>Proje İstatistiklerimiz</h2>
        <p>Sayılarla başarı hikayemiz</p>
    </div>
    <div class="stats-grid">
        <div class="stat-card">
            <i class="fas fa-project-diagram"></i>
            <h4>150+</h4>
            <p>Tamamlanan Proje</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-globe"></i>
            <h4>15+</h4>
            <p>Farklı Sektör</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-code-branch"></i>
            <h4>50K+</h4>
            <p>Git Commit</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-coffee"></i>
            <h4>10K+</h4>
            <p>Kahve Tüketimi</p>
        </div>
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
