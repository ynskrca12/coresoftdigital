@extends('layouts.master')

@section('title', 'Hakkımızda - CoreSoft Digital | Genç & Dinamik Yazılım Ekibi')

@section('meta_description', 'CoreSoft Digital - Yeni nesil yazılım çözümleri sunan genç ve dinamik ekibimiz. Modern teknolojiler, tutkulu geliştiriciler ve müşteri odaklı yaklaşım.')

@section('meta_keywords', 'genç yazılım ekibi, startup yazılım, modern teknolojiler, dinamik ekip, yazılım girişimi, yeni nesil yazılım')

@section('styles')
<style>
    /* Hero Section - Modern & Energetic */
    .about-hero {
        padding: 8rem 5% 5rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 50% 50%, rgba(37, 99, 235, 0.1) 0%, transparent 50%);
        animation: pulse 4s ease-in-out infinite;
    }

    .about-hero h1 {
        font-size: 4rem;
        font-weight: 800;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1.5rem;
        animation: fadeInUp 0.8s ease-out;
        position: relative;
        z-index: 1;
    }

    .about-hero .subtitle {
        font-size: 1.8rem;
        color: var(--accent);
        font-weight: 600;
        margin-bottom: 1rem;
        animation: fadeInUp 0.8s ease-out 0.1s backwards;
    }

    .about-hero p {
        font-size: 1.3rem;
        color: rgba(248, 250, 252, 0.8);
        max-width: 900px;
        margin: 0 auto;
        line-height: 1.8;
        animation: fadeInUp 0.8s ease-out 0.2s backwards;
    }

    /* Story Section - New Approach */
    .story-section {
        padding: 5rem 5%;
    }

    .story-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .story-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .story-card {
        background: rgba(30, 41, 59, 0.5);
        padding: 3rem;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .story-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 0;
        background: var(--gradient);
        transition: height 0.3s ease;
    }

    .story-card:hover::before {
        height: 100%;
    }

    .story-card:hover {
        transform: translateY(-10px);
        border-color: var(--accent);
        box-shadow: 0 20px 40px rgba(6, 182, 212, 0.3);
    }

    .story-icon {
        width: 70px;
        height: 70px;
        background: var(--gradient);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        margin-bottom: 1.5rem;
        animation: float 3s ease-in-out infinite;
    }

    .story-card h3 {
        font-size: 1.6rem;
        margin-bottom: 1rem;
        color: var(--light);
    }

    .story-card p {
        color: rgba(248, 250, 252, 0.8);
        line-height: 1.8;
        font-size: 1.05rem;
    }

    /* Mission Vision Section */
    .mission-section {
        padding: 5rem 5%;
    }

    .mission-container {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
    }

    .mission-box {
        background: rgba(30, 41, 59, 0.5);
        padding: 3rem;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    .mission-box::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: conic-gradient(
            from 0deg at 50% 50%,
            transparent 0deg,
            rgba(37, 99, 235, 0.05) 90deg,
            transparent 180deg
        );
        animation: rotate 8s linear infinite;
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .mission-box:hover::after {
        opacity: 1;
    }

    .mission-icon {
        font-size: 3rem;
        margin-bottom: 1.5rem;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .mission-box h3 {
        font-size: 2rem;
        margin-bottom: 1.5rem;
        color: var(--light);
    }

    .mission-box p {
        color: rgba(248, 250, 252, 0.8);
        line-height: 1.9;
        font-size: 1.1rem;
    }

    /* Values Section - Modern Cards */
    .values-section {
        padding: 5rem 5%;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        max-width: 1400px;
        margin: 3rem auto 0;
    }

    .value-card {
        background: rgba(30, 41, 59, 0.5);
        padding: 2.5rem;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
        transition: all 0.4s ease;
        backdrop-filter: blur(10px);
        position: relative;
    }

    .value-card::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 20px;
        padding: 2px;
        background: var(--gradient);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .value-card:hover::before {
        opacity: 1;
    }

    .value-card:hover {
        transform: translateY(-15px) scale(1.02);
        border-color: transparent;
        box-shadow: 0 25px 50px rgba(6, 182, 212, 0.3);
    }

    .value-icon {
        width: 90px;
        height: 90px;
        margin: 0 auto 1.5rem;
        background: var(--gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        color: white;
        position: relative;
        animation: float 3s ease-in-out infinite;
    }

    .value-icon::after {
        content: '';
        position: absolute;
        inset: -5px;
        border-radius: 50%;
        background: var(--gradient);
        opacity: 0.3;
        filter: blur(15px);
        z-index: -1;
    }

    .value-card h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--light);
    }

    .value-card p {
        color: rgba(248, 250, 252, 0.8);
        line-height: 1.8;
    }

    /* Team Section - Realistic */
    .team-section {
        padding: 5rem 5%;
    }

    .team-intro {
        max-width: 800px;
        margin: 0 auto 3rem;
        text-align: center;
        padding: 2rem;
        background: rgba(30, 41, 59, 0.3);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .team-intro p {
        color: rgba(248, 250, 252, 0.8);
        font-size: 1.1rem;
        line-height: 1.8;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .team-card {
        background: rgba(30, 41, 59, 0.5);
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
        transition: all 0.4s ease;
        backdrop-filter: blur(10px);
    }

    .team-card:hover {
        transform: translateY(-15px);
        border-color: var(--accent);
        box-shadow: 0 20px 40px rgba(6, 182, 212, 0.3);
    }

    .team-avatar {
        width: 100%;
        height: 280px;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 6rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .team-avatar::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
        transform: translateX(-100%);
        transition: transform 0.6s ease;
    }

    .team-card:hover .team-avatar::before {
        transform: translateX(100%);
    }

    .team-info {
        padding: 2rem;
    }

    .team-info h3 {
        font-size: 1.4rem;
        margin-bottom: 0.5rem;
        color: var(--light);
    }

    .team-role {
        color: var(--accent);
        font-size: 1rem;
        margin-bottom: 0.8rem;
        font-weight: 500;
    }

    .team-bio {
        color: rgba(248, 250, 252, 0.7);
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .team-social {
        display: flex;
        gap: 0.8rem;
        justify-content: center;
    }

    .team-social a {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(37, 99, 235, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        transition: all 0.3s ease;
    }

    .team-social a:hover {
        background: var(--gradient);
        color: white;
        transform: translateY(-3px) rotate(5deg);
    }

    /* Tech Stack Section */
    .tech-stack-section {
        padding: 5rem 5%;
    }

    .tech-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 3rem auto 0;
    }

    .tech-item {
        background: rgba(30, 41, 59, 0.5);
        padding: 2rem 1rem;
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .tech-item:hover {
        transform: translateY(-10px);
        border-color: var(--accent);
        box-shadow: 0 15px 30px rgba(6, 182, 212, 0.2);
    }

    .tech-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .tech-name {
        font-size: 0.95rem;
        color: rgba(248, 250, 252, 0.8);
        font-weight: 500;
    }

    /* CTA Section */
    .cta-section {
        padding: 5rem 5%;
    }

    .cta-box {
        max-width: 900px;
        margin: 0 auto;
        background: var(--gradient);
        padding: 4rem 3rem;
        border-radius: 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-box::before {
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

    .cta-box h2 {
        font-size: 2.5rem;
        color: white;
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }

    .cta-box p {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 2rem;
        position: relative;
        z-index: 1;
    }

    .btn-cta {
        background: white;
        color: var(--primary);
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .about-hero h1 {
            font-size: 2.5rem;
        }

        .about-hero .subtitle {
            font-size: 1.3rem;
        }

        .about-hero p {
            font-size: 1.1rem;
        }

        .story-cards {
            grid-template-columns: 1fr;
        }

        .mission-container {
            grid-template-columns: 1fr;
        }

        .tech-grid {
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 1rem;
        }

        .cta-box {
            padding: 3rem 2rem;
        }

        .cta-box h2 {
            font-size: 1.8rem;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero -->
<section class="about-hero">
    <div class="subtitle">🚀 Yeni Nesil Yazılım Ekibi</div>
    <h1>Genç, Dinamik & Tutkulu</h1>
    <p>
        Modern teknolojilere hakim, yenilikçi çözümler üreten ve müşteri memnuniyetini
        ön planda tutan genç bir ekibiz. 2025 yılında başlattığımız bu yolculukta,
        her projeyi bir öğrenme ve gelişme fırsatı olarak görüyoruz.
    </p>
</section>

<!-- Story Section -->
<section class="story-section">
    <div class="story-container">
        <div class="section-header">
            <h2>Biz Kimiz?</h2>
            <p>Hikayemiz daha yeni başlıyor, ama vizyonumuz net</p>
        </div>
        <div class="story-cards">
            <div class="story-card">
                <div class="story-icon">
                    <i class="fas fa-rocket"></i>
                </div>
                <h3>Taze Başlangıç</h3>
                <p>
                    CoreSoft Digital, 2025 yılında teknoloji tutkunu bir grup genç yazılımcı
                    tarafından kuruldu. Sektörde yıllarca deneyim kazanmış ekip üyelerimiz,
                    kendi vizyonlarını hayata geçirmek için bir araya geldi.
                </p>
            </div>
            <div class="story-card">
                <div class="story-icon">
                    <i class="fas fa-fire"></i>
                </div>
                <h3>Tutkulu Ekip</h3>
                <p>
                    Tutkuyla çalışan, alanında uzman bir ekibiz. Her birimiz sürekli öğrenen, yenilikleri takip eden ve gelişime açık profesyonellerden oluşuyoruz. Hızlı, çevik ve çözüm odaklı yapımız sayesinde projeleri verimli şekilde hayata geçiriyor, müşterilerimize en iyi deneyimi sunuyoruz.
                </p>
            </div>
            <div class="story-card">
                <div class="story-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3>Net Hedefler</h3>
                <p>
                    Hedefimiz basit: Kaliteli, modern ve sürdürülebilir yazılım çözümleri
                    üretmek. Her projede %100 müşteri memnuniyeti sağlamak ve
                    uzun vadeli iş ortaklıkları kurmak istiyoruz.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="mission-section">
    <div class="mission-container">
        <div class="mission-box">
            <div class="mission-icon">
                <i class="fas fa-compass"></i>
            </div>
            <h3>Vizyonumuz</h3>
            <p>
              Türkiye’de yeni nesil yazılım çözümlerinin öncüsü olmayı hedefliyoruz. Teknolojiyi yenilikçi bir bakış açısıyla birleştirerek işletmelerin dijital dönüşüm süreçlerine yön vermeyi amaçlıyoruz. Güvenilir, sürdürülebilir ve etkili yazılım çözümleriyle müşterilerimizin iş hedeflerine ulaşmalarını desteklerken, sektörde fark yaratan bir teknoloji markası olma yolunda ilerliyoruz.
            </p>
        </div>
        <div class="mission-box">
            <div class="mission-icon">
                <i class="fas fa-flag"></i>
            </div>
            <h3>Misyonumuz</h3>
            <p>
                Modern teknolojileri kullanarak, her bütçeye uygun, kaliteli ve
                sürdürülebilir yazılım çözümleri sunmak. Müşterilerimizle şeffaf
                iletişim kurmak ve onların dijital dönüşüm yolculuğunda güvenilir
                bir partner olmak.
            </p>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="values-section">
    <div class="section-header">
        <h2>Değerlerimiz</h2>
        <p>Bizi biz yapan prensipler</p>
    </div>
    <div class="values-grid">
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-handshake"></i>
            </div>
            <h3>Şeffaflık</h3>
            <p>
                Müşterilerimizle her aşamada açık ve dürüst iletişim kuruyoruz.
                Gizli maliyet yok, sürpriz fiyatlandırma yok. Her şey net ve anlaşılır.
            </p>
        </div>
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h3>Sürekli Öğrenme</h3>
            <p>
                Teknoloji hızla değişiyor ve biz de onunla birlikte. Her gün yeni
                şeyler öğreniyor, kendimizi geliştiriyor ve bu bilgiyi projelerimize yansıtıyoruz.
            </p>
        </div>
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-clock"></i>
            </div>
            <h3>Hız & Esneklik</h3>
            <p>
                Büyük şirketlerin bürokratik süreçlerinden uzağız. Hızlı karar alır,
                hızlı prototip yapar ve projeleri zamanında teslim ederiz.
            </p>
        </div>
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-heart"></i>
            </div>
            <h3>Müşteri Odaklı</h3>
            <p>
                Sizin başarınız bizim başarımız. Her projeyi kendi projemiz gibi
                sahipleniyor ve en iyi sonucu almak için çabalıyoruz.
            </p>
        </div>
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-code"></i>
            </div>
            <h3>Kaliteli Kod</h3>
            <p>
                Sadece çalışan değil, temiz, sürdürülebilir ve ölçeklenebilir kod
                yazıyoruz. Bugün yapılan iş, yarın da değerini korumalı.
            </p>
        </div>
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-balance-scale"></i>
            </div>
            <h3>Uygun Fiyat</h3>
            <p>
                Kaliteli yazılım pahalı olmak zorunda değil. Küçük ve orta ölçekli
                işletmelerin bütçesine uygun çözümler sunuyoruz.
            </p>
        </div>
    </div>
</section>

<!-- Tech Stack -->
<section class="tech-stack-section">
    <div class="section-header">
        <h2>Teknoloji Ağımız</h2>
        <p>Modern ve güncel teknolojilerle çalışıyoruz</p>
    </div>
    <div class="tech-grid">
        <div class="tech-item">
            <div class="tech-icon"><i class="fab fa-laravel"></i></div>
            <div class="tech-name">Laravel</div>
        </div>
        <div class="tech-item">
            <div class="tech-icon"><i class="fab fa-react"></i></div>
            <div class="tech-name">React</div>
        </div>
        <div class="tech-item">
            <div class="tech-icon"><i class="fab fa-vuejs"></i></div>
            <div class="tech-name">Vue.js</div>
        </div>
        <div class="tech-item">
            <div class="tech-icon"><i class="fab fa-node-js"></i></div>
            <div class="tech-name">Node.js</div>
        </div>
        <div class="tech-item">
            <div class="tech-icon"><i class="fab fa-php"></i></div>
            <div class="tech-name">PHP</div>
        </div>
        <div class="tech-item">
            <div class="tech-icon"><i class="fab fa-python"></i></div>
            <div class="tech-name">Python</div>
        </div>
        <div class="tech-item">
            <div class="tech-icon"><i class="fab fa-js"></i></div>
            <div class="tech-name">JavaScript</div>
        </div>
        <div class="tech-item">
            <div class="tech-icon"><i class="fab fa-docker"></i></div>
            <div class="tech-name">Docker</div>
        </div>
        <div class="tech-item">
            <div class="tech-icon"><i class="fab fa-git-alt"></i></div>
            <div class="tech-name">Git</div>
        </div>
        <div class="tech-item">
            <div class="tech-icon"><i class="fab fa-aws"></i></div>
            <div class="tech-name">AWS</div>
        </div>
        <div class="tech-item">
            <div class="tech-icon"><i class="fas fa-database"></i></div>
            <div class="tech-name">MySQL</div>
        </div>
        <div class="tech-item">
            <div class="tech-icon"><i class="fas fa-database"></i></div>
            <div class="tech-name">PostgreSQL</div>
        </div>
    </div>
</section>

<!-- Team Section -->
{{-- <section class="team-section">
    <div class="section-header">
        <h2>Ekibimiz</h2>
        <p>Küçük ama güçlü ekibimizle tanışın</p>
    </div>
    <div class="team-intro">
        <p>
            <strong>Şu an 3 kişilik bir çekirdek ekibiz.</strong> Her birimiz farklı alanlarda
            uzmanlaşmış, yıllarca farklı şirketlerde çalışmış ve şimdi kendi vizyonumuzu
            hayata geçirmek için bir araya gelmiş yazılımcılarız. Büyük projeler için
            güvenilir freelance ortaklarımızla da çalışıyoruz.
        </p>
    </div>
    <div class="team-grid">
        <div class="team-card">
            <div class="team-avatar">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="team-info">
                <h3>Ali Yılmaz</h3>
                <div class="team-role">Kurucu & Full-Stack Developer</div>
                <p class="team-bio">
                    5+ yıl deneyimli. Laravel ve React uzmanı. Daha önce
                    çeşitli startuplarda çalıştı.
                </p>
                <div class="team-social">
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <div class="team-card">
            <div class="team-avatar">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="team-info">
                <h3>Ayşe Kaya</h3>
                <div class="team-role">Frontend Developer & UI/UX</div>
                <p class="team-bio">
                    4+ yıl deneyim. Modern UI/UX tasarım ve React/Vue.js
                    geliştirme konularında uzman.
                </p>
                <div class="team-social">
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    <a href="#" aria-label="Behance"><i class="fab fa-behance"></i></a>
                    <a href="#" aria-label="Dribbble"><i class="fab fa-dribbble"></i></a>
                </div>
            </div>
        </div>
        <div class="team-card">
            <div class="team-avatar">
                <i class="fas fa-user-cog"></i>
            </div>
            <div class="team-info">
                <h3>Mehmet Demir</h3>
                <div class="team-role">Backend Developer & DevOps</div>
                <p class="team-bio">
                    6+ yıl sektör deneyimi. PHP, Python ve cloud teknolojileri
                    konusunda uzman.
                </p>
                <div class="team-social">
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
                    <a href="#" aria-label="Stack Overflow"><i class="fab fa-stack-overflow"></i></a>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<!-- CTA Section -->
<section class="cta-section">
    <div class="cta-box">
        <h2>Projenizi Birlikte Gerçekleştirelim</h2>
        <p>
            Dinamik ekibimizle her projeye özel ilgi ve özen gösteriyoruz. Sizinle iş birliği yapmaktan memnuniyet duyarız.
        </p>
        <a href="{{ route('contact') }}" class="btn-cta">
            <i class="fas fa-paper-plane"></i>
            Hemen İletişime Geçin
        </a>
    </div>
</section>
@endsection
