@extends('layouts.master')

@section('title', 'İletişim - CoreSoft Digital')

@section('meta_description', 'CoreSoft Digital ile iletişime geçin. Projeleriniz için ücretsiz danışmanlık ve teklif alın.')

@section('meta_keywords', 'iletişim, yazılım teklif, proje danışmanlığı, istanbul yazılım iletişim')

@section('styles')
<style>
    .contact-hero {
        padding: 8rem 5% 5rem;
        text-align: center;
    }

    .contact-hero h1 {
        font-size: 4rem;
        font-weight: 800;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1.5rem;
        animation: fadeInUp 0.8s ease-out;
    }

    .contact-hero p {
        font-size: 1.5rem;
        color: rgba(248, 250, 252, 0.7);
        max-width: 800px;
        margin: 0 auto;
        animation: fadeInUp 0.8s ease-out 0.2s backwards;
    }

    .contact-container {
        padding: 5rem 5%;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 4rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .info-card {
        background: rgba(30, 41, 59, 0.5);
        padding: 2rem;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-5px);
        border-color: var(--accent);
        box-shadow: 0 10px 30px rgba(6, 182, 212, 0.2);
    }

    .info-icon {
        width: 60px;
        height: 60px;
        background: var(--gradient);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-bottom: 1.5rem;
    }

    .info-card h3 {
        font-size: 1.3rem;
        margin-bottom: 0.8rem;
    }

    .info-card p {
        color: rgba(248, 250, 252, 0.7);
        line-height: 1.8;
    }

    .info-card a {
        color: var(--accent);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .info-card a:hover {
        color: var(--primary);
    }

    .social-links-large {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .social-links-large a {
        width: 50px;
        height: 50px;
        border-radius: 15px;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .social-links-large a:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.4);
    }

    .contact-form {
        background: rgba(30, 41, 59, 0.5);
        padding: 3rem;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: rgba(248, 250, 252, 0.9);
        font-weight: 600;
    }

    .form-control {
        width: 100%;
        padding: 1rem;
        background: rgba(15, 23, 42, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        color: var(--light);
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--accent);
        background: rgba(15, 23, 42, 0.7);
        box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1);
    }

    textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .submit-btn {
        width: 100%;
        padding: 1.2rem;
        background: var(--gradient);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(37, 99, 235, 0.4);
    }

    .map-section {
        padding: 5rem 5%;
        background: rgba(30, 41, 59, 0.3);
    }

    .map-container {
        max-width: 1400px;
        margin: 0 auto;
        height: 500px;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(30, 41, 59, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
    }

    .map-placeholder {
        text-align: center;
        color: rgba(248, 250, 252, 0.5);
    }

    .map-placeholder i {
        font-size: 5rem;
        margin-bottom: 1rem;
        opacity: 0.3;
    }

    .faq-section {
        padding: 5rem 5%;
    }

    .faq-container {
        max-width: 900px;
        margin: 3rem auto 0;
    }

    .faq-item {
        background: rgba(30, 41, 59, 0.5);
        border-radius: 15px;
        margin-bottom: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .faq-question {
        padding: 1.5rem;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
    }

    .faq-question:hover {
        background: rgba(37, 99, 235, 0.1);
    }

    .faq-question h3 {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .faq-icon {
        font-size: 1.2rem;
        color: var(--accent);
        transition: transform 0.3s ease;
    }

    .faq-item.active .faq-icon {
        transform: rotate(180deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .faq-answer-content {
        padding: 0 1.5rem 1.5rem;
        color: rgba(248, 250, 252, 0.7);
        line-height: 1.8;
    }

    @media (max-width: 768px) {
        .contact-hero h1 {
            font-size: 2.5rem;
        }

        .contact-grid {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero -->
<section class="contact-hero">
    <h1>İletişime Geçin</h1>
    <p>
        Projeleriniz hakkında konuşmak veya sorularınızı yanıtlamak için buradayız.
        En kısa sürede size dönüş yapacağız.
    </p>
</section>

<!-- Contact Section -->
<section class="contact-container">
    <div class="contact-grid">
        <!-- Contact Info -->
        <div class="contact-info">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <h3>Telefon</h3>
                <p>
                    Hafta içi 09:00 - 18:00 saatleri arasında<br>
                    <a href="tel:+905XXXXXXXXX">+90 (XXX) XXX XX XX</a>
                </p>
            </div>

            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3>E-posta</h3>
                <p>
                    Sorularınız için<br>
                    <a href="mailto:info@coresoftdigital.com">info@coresoftdigital.com</a><br>
                    <a href="mailto:support@coresoftdigital.com">support@coresoftdigital.com</a>
                </p>
            </div>

            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3>Adres</h3>
                <p>
                    CoreSoft Digital Yazılım A.Ş.<br>
                    Maslak Mahallesi, Büyükdere Caddesi<br>
                    No: 123, Kat: 5<br>
                    Sarıyer, İstanbul 34398
                </p>
            </div>

            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-share-alt"></i>
                </div>
                <h3>Sosyal Medya</h3>
                <p>Bizi takip edin</p>
                <div class="social-links-large">
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <form class="contact-form" id="contactForm">
            <h2 style="margin-bottom: 2rem; background: var(--gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                Bize Mesaj Gönderin
            </h2>

            <div class="form-row">
                <div class="form-group">
                    <label for="name">Adınız Soyadınız *</label>
                    <input type="text" id="name" class="form-control" required placeholder="Adınız Soyadınız">
                </div>

                <div class="form-group">
                    <label for="company">Şirket Adı</label>
                    <input type="text" id="company" class="form-control" placeholder="Şirket adınız (opsiyonel)">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">E-posta *</label>
                    <input type="email" id="email" class="form-control" required placeholder="ornek@email.com">
                </div>

                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input type="tel" id="phone" class="form-control" placeholder="+90 (XXX) XXX XX XX">
                </div>
            </div>

            <div class="form-group">
                <label for="subject">Konu *</label>
                <input type="text" id="subject" class="form-control" required placeholder="Mesajınızın konusu">
            </div>

            <div class="form-group">
                <label for="message">Mesajınız *</label>
                <textarea id="message" class="form-control" required placeholder="Proje detaylarınızı veya sorularınızı buraya yazabilirsiniz..."></textarea>
            </div>

            <div class="form-group">
                <label for="budget">Bütçe Aralığı</label>
                <select id="budget" class="form-control">
                    <option value="">Seçiniz</option>
                    <option value="0-25k">0 - 25.000 TL</option>
                    <option value="25k-50k">25.000 - 50.000 TL</option>
                    <option value="50k-100k">50.000 - 100.000 TL</option>
                    <option value="100k+">100.000 TL üzeri</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">
                <i class="fas fa-paper-plane"></i>
                Mesaj Gönder
            </button>
        </form>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="section-header">
        <h2>Ofisimizi Ziyaret Edin</h2>
        <p>İstanbul Maslak'taki ofisimizde görüşmek üzere</p>
    </div>
    <div class="map-container">
        <div class="map-placeholder">
            <i class="fas fa-map-marked-alt"></i>
            <p>Google Maps Entegrasyonu</p>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="section-header">
        <h2>Sık Sorulan Sorular</h2>
        <p>Merak ettikleriniz</p>
    </div>
    <div class="faq-container">
        <div class="faq-item">
            <div class="faq-question">
                <h3>Proje geliştirme süreci nasıl işliyor?</h3>
                <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-content">
                    Öncelikle ihtiyaçlarınızı dinliyor ve detaylı bir analiz yapıyoruz. Ardından teknik dokümantasyon
                    ve prototip oluşturuyoruz. Onayınızın ardından geliştirme sürecini başlatıyor, düzenli güncellemeler
                    ile sizi bilgilendiriyoruz. Test sürecinden sonra projeyi teslim ediyoruz.
                </div>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>Bir projenin ortalama teslim süresi ne kadardır?</h3>
                <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-content">
                    Proje süreleri, karmaşıklık ve kapsama göre değişiklik gösterir. Basit web siteleri 2-4 hafta,
                    orta ölçekli projeler 2-4 ay, karmaşık enterprise çözümleri ise 6-12 ay sürebilir.
                    İlk görüşmede size net bir zaman çizelgesi sunuyoruz.
                </div>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>Proje sonrası destek hizmeti veriyor musunuz?</h3>
                <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-content">
                    Evet, tüm projelerimizde 3 ay ücretsiz teknik destek sunuyoruz. Bu süre sonrasında isteğe bağlı
                    olarak aylık veya yıllık destek paketlerimizden faydalanabilirsiniz. Ayrıca acil müdahale
                    ve güncelleme hizmetleri de sağlıyoruz.
                </div>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>Hangi teknolojileri kullanıyorsunuz?</h3>
                <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-content">
                    Backend için Laravel, Node.js ve Python; frontend için React, Vue.js ve Angular;
                    mobil için Flutter ve React Native kullanıyoruz. Veritabanı olarak MySQL, PostgreSQL ve MongoDB
                    tercih ediyoruz. Projenizin ihtiyaçlarına göre en uygun teknoloji yığınını seçiyoruz.
                </div>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>Fiyatlandırma nasıl yapılıyor?</h3>
                <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-content">
                    Her proje için özel fiyat teklifi hazırlıyoruz. Projenin kapsamı, karmaşıklığı, süre ve
                    kaynak ihtiyacına göre detaylı bir maliyet analizi sunuyoruz. Şeffaf fiyatlandırma politikamız
                    sayesinde gizli maliyetlerle karşılaşmazsınız.
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Form submission
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Simulate form submission
        const btn = this.querySelector('.submit-btn');
        const originalText = btn.innerHTML;

        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Gönderiliyor...';
        btn.disabled = true;

        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-check"></i> Gönderildi!';
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
                this.reset();
            }, 2000);
        }, 1500);
    });

    // FAQ Accordion
    document.querySelectorAll('.faq-question').forEach(question => {
        question.addEventListener('click', () => {
            const item = question.parentElement;
            const answer = item.querySelector('.faq-answer');
            const isActive = item.classList.contains('active');

            // Close all other items
            document.querySelectorAll('.faq-item').forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                    otherItem.querySelector('.faq-answer').style.maxHeight = null;
                }
            });

            // Toggle current item
            if (isActive) {
                item.classList.remove('active');
                answer.style.maxHeight = null;
            } else {
                item.classList.add('active');
                answer.style.maxHeight = answer.scrollHeight + 'px';
            }
        });
    });
</script>
@endsection
