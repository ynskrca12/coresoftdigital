@extends('layouts.master')

@section('title', 'Hakkımızda - CoreSoft Digital')

@section('meta_description', 'CoreSoft Digital hakkında her şey. Hikayemiz, değerlerimiz, ekibimiz ve yolculuğumuz.')

@section('meta_keywords', 'coresoft digital hakkında, yazılım şirketi, ekibimiz, değerlerimiz')

@section('styles')
<style>
    .about-hero {
        padding: 8rem 5% 5rem;
        text-align: center;
    }

    .about-hero h1 {
        font-size: 4rem;
        font-weight: 800;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1.5rem;
        animation: fadeInUp 0.8s ease-out;
    }

    .about-hero p {
        font-size: 1.5rem;
        color: rgba(248, 250, 252, 0.7);
        max-width: 800px;
        margin: 0 auto;
        animation: fadeInUp 0.8s ease-out 0.2s backwards;
    }

    .story-section {
        padding: 5rem 5%;
        background: rgba(30, 41, 59, 0.3);
    }

    .story-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    .story-image {
        position: relative;
        height: 500px;
        border-radius: 20px;
        overflow: hidden;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        animation: float 3s ease-in-out infinite;
    }

    .story-image i {
        font-size: 10rem;
        color: white;
        opacity: 0.9;
    }

    .story-content h2 {
        font-size: 2.5rem;
        font-weight: 800;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1.5rem;
    }

    .story-content p {
        font-size: 1.1rem;
        color: rgba(248, 250, 252, 0.8);
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

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
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .value-card:hover {
        transform: translateY(-10px);
        border-color: var(--accent);
        box-shadow: 0 20px 40px rgba(6, 182, 212, 0.2);
    }

    .value-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: var(--gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
    }

    .value-card h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .value-card p {
        color: rgba(248, 250, 252, 0.7);
        line-height: 1.8;
    }

    .team-section {
        padding: 5rem 5%;
        background: rgba(30, 41, 59, 0.3);
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        max-width: 1400px;
        margin: 3rem auto 0;
    }

    .team-card {
        background: rgba(30, 41, 59, 0.5);
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .team-card:hover {
        transform: translateY(-10px);
        border-color: var(--accent);
        box-shadow: 0 20px 40px rgba(6, 182, 212, 0.2);
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
    }

    .team-info {
        padding: 2rem;
    }

    .team-info h3 {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
    }

    .team-role {
        color: var(--accent);
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .team-social {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .team-social a {
        width: 36px;
        height: 36px;
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
        transform: translateY(-3px);
    }

    .timeline-section {
        padding: 5rem 5%;
    }

    .timeline {
        max-width: 1000px;
        margin: 3rem auto 0;
        position: relative;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 100%;
        background: var(--gradient);
    }

    .timeline-item {
        display: flex;
        gap: 2rem;
        margin-bottom: 3rem;
        position: relative;
    }

    .timeline-item:nth-child(odd) {
        flex-direction: row;
    }

    .timeline-item:nth-child(even) {
        flex-direction: row-reverse;
    }

    .timeline-content {
        flex: 1;
        background: rgba(30, 41, 59, 0.5);
        padding: 2rem;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }

    .timeline-year {
        font-size: 2rem;
        font-weight: 800;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
    }

    .timeline-content h3 {
        font-size: 1.3rem;
        margin-bottom: 1rem;
    }

    .timeline-content p {
        color: rgba(248, 250, 252, 0.7);
        line-height: 1.8;
    }

    .timeline-dot {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 20px;
        background: var(--gradient);
        border-radius: 50%;
        border: 4px solid var(--dark);
        z-index: 1;
    }

    @media (max-width: 768px) {
        .about-hero h1 {
            font-size: 2.5rem;
        }

        .story-container {
            grid-template-columns: 1fr;
        }

        .story-image {
            height: 300px;
        }

        .timeline::before {
            left: 20px;
        }

        .timeline-item:nth-child(odd),
        .timeline-item:nth-child(even) {
            flex-direction: row;
            padding-left: 50px;
        }

        .timeline-dot {
            left: 20px;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero -->
<section class="about-hero">
    <h1>Hakkımızda</h1>
    <p>
        Teknoloji tutkusuyla başlayan yolculuğumuz, bugün yüzlerce başarılı projeyle devam ediyor.
    </p>
</section>

<!-- Story Section -->
<section class="story-section">
    <div class="story-container">
        <div class="story-image">
            <i class="fas fa-rocket"></i>
        </div>
        <div class="story-content">
            <h2>Hikayemiz</h2>
            <p>
                CoreSoft Digital, 2018 yılında dijital dönüşüm ve yazılım geliştirme alanında
                kaliteli hizmet sunma vizyonuyla kuruldu. Küçük bir ekiple başladığımız yolculuğumuz,
                bugün 30'dan fazla uzman kadromuz ve 150'yi aşkın başarılı projemizle devam ediyor.
            </p>
            <p>
                Müşteri odaklı yaklaşımımız, yenilikçi çözümlerimiz ve kaliteden ödün vermeme
                prensiplerimiz sayesinde, Türkiye'nin önde gelen yazılım şirketlerinden biri haline geldik.
            </p>
            <p>
                Her proje bizim için bir öğrenme ve gelişme fırsatı. Teknolojinin hızla değiştiği
                bu dünyada, kendimizi sürekli güncel tutarak müşterilerimize en iyi çözümleri sunmaya
                devam ediyoruz.
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
                <i class="fas fa-lightbulb"></i>
            </div>
            <h3>İnovasyon</h3>
            <p>
                Sürekli gelişim ve yenilik peşinde koşuyoruz. En güncel teknolojileri
                takip ediyor ve projelerimize uyguluyoruz.
            </p>
        </div>
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3>Güvenilirlik</h3>
            <p>
                Müşterilerimizin güveni bizim için en değerli varlık. Sözümüzü tutmak
                ve beklentileri aşmak temel prensiplerimizdendir.
            </p>
        </div>
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-star"></i>
            </div>
            <h3>Kalite</h3>
            <p>
                Her projede mükemmellik standartlarını yakalama hedefiyle çalışıyoruz.
                Kaliteden asla ödün vermiyoruz.
            </p>
        </div>
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-users"></i>
            </div>
            <h3>Ekip Ruhu</h3>
            <p>
                Başarının sırrı güçlü bir ekipte. Birlikte çalışma kültürümüz
                ve pozitif atmosferimiz başarımızın temelidir.
            </p>
        </div>
    </div>
</section>

<!-- Timeline Section -->
<section class="timeline-section">
    <div class="section-header">
        <h2>Yolculuğumuz</h2>
        <p>Önemli kilometre taşlarımız</p>
    </div>
    <div class="timeline">
        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-year">2018</div>
                <h3>Kuruluş</h3>
                <p>
                    CoreSoft Digital, İstanbul'da 5 kişilik bir ekiple yazılım geliştirme
                    alanında hizmet vermeye başladı.
                </p>
            </div>
            <div class="timeline-dot"></div>
        </div>
        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-year">2019</div>
                <h3>İlk Büyük Proje</h3>
                <p>
                    Türkiye'nin önde gelen e-ticaret firmalarından biri için kapsamlı
                    platform geliştirdik ve 50+ projeyi tamamladık.
                </p>
            </div>
            <div class="timeline-dot"></div>
        </div>
        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-year">2021</div>
                <h3>Ekip Genişlemesi</h3>
                <p>
                    Artan talep ile birlikte ekibimizi 20 kişiye çıkardık ve yeni ofisimize taşındık.
                    Mobil uygulama geliştirme bölümümüzü kurduk.
                </p>
            </div>
            <div class="timeline-dot"></div>
        </div>
        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-year">2023</div>
                <h3>Uluslararası Projeler</h3>
                <p>
                    İlk uluslararası projelerimizi aldık ve Avrupa pazarına açıldık.
                    100+ proje kilometre taşını geçtik.
                </p>
            </div>
            <div class="timeline-dot"></div>
        </div>
        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-year">2025</div>
                <h3>Yeni Hedefler</h3>
                <p>
                    30+ kişilik uzman ekibimizle AI ve cloud çözümleri alanında da
                    hizmet vermeye başladık. 150+ başarılı projeye ulaştık.
                </p>
            </div>
            <div class="timeline-dot"></div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team-section">
    <div class="section-header">
        <h2>Ekibimiz</h2>
        <p>Başarımızın mimarları</p>
    </div>
    <div class="team-grid">
        <div class="team-card">
            <div class="team-avatar">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="team-info">
                <h3>Ahmet Yılmaz</h3>
                <div class="team-role">Kurucu & CEO</div>
                <div class="team-social">
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </div>
        <div class="team-card">
            <div class="team-avatar">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="team-info">
                <h3>Ayşe Demir</h3>
                <div class="team-role">CTO</div>
                <div class="team-social">
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </div>
        <div class="team-card">
            <div class="team-avatar">
                <i class="fas fa-user-cog"></i>
            </div>
            <div class="team-info">
                <h3>Mehmet Kaya</h3>
                <div class="team-role">Lead Developer</div>
                <div class="team-social">
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </div>
        <div class="team-card">
            <div class="team-avatar">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="team-info">
                <h3>Zeynep Öz</h3>
                <div class="team-role">UI/UX Designer</div>
                <div class="team-social">
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-dribbble"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
