@extends('layouts.master')

@section('title', '404 - Sayfa Bulunamadı')

@section('meta_description', 'Aradığınız sayfa bulunamadı. CoreSoft Digital ana sayfasına dönebilir veya diğer sayfalarımızı ziyaret edebilirsiniz.')

@section('styles')
<style>
    .error-page {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 5%;
        text-align: center;
    }

    .error-content {
        max-width: 700px;
    }

    .error-code {
        font-size: 12rem;
        font-weight: 800;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
        margin-bottom: 1rem;
        animation: float 3s ease-in-out infinite;
    }

    .error-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--light);
    }

    .error-message {
        font-size: 1.2rem;
        color: rgba(248, 250, 252, 0.7);
        margin-bottom: 2.5rem;
        line-height: 1.8;
    }

    .error-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 3rem;
        margin-top: 15px;
    }

    .error-illustration {
        margin-bottom: 1rem;
        font-size: 6rem;
        color: var(--primary);
        animation: pulse 2s ease-in-out infinite;
    }

    .quick-links {
        background: rgba(30, 41, 59, 0.5);
        padding: 2rem;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        margin-top: 2rem;
    }

    .quick-links h3 {
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
        color: var(--light);
    }

    .links-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }

    .quick-link-item {
        padding: 1rem;
        background: rgba(15, 23, 42, 0.5);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-decoration: none;
        color: var(--light);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
    }

    .quick-link-item:hover {
        transform: translateY(-5px);
        border-color: var(--accent);
        background: rgba(37, 99, 235, 0.1);
    }

    .quick-link-item i {
        font-size: 2rem;
        color: var(--accent);
    }

    .quick-link-item span {
        font-size: 0.9rem;
    }

    .error-url {
        margin-top: 2rem;
        padding: 1rem;
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        border-radius: 10px;
        color: rgba(248, 250, 252, 0.6);
        font-family: 'Courier New', monospace;
        word-break: break-all;
    }

    @media (max-width: 768px) {
        .error-code {
            font-size: 8rem;
        }

        .error-title {
            font-size: 1.8rem;
        }

        .error-message {
            font-size: 1rem;
        }

        .error-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }

        .error-illustration {
            font-size: 4rem;
        }

        .links-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="error-page">
    <div class="error-content">
        <div class="error-illustration">
            <i class="fas fa-search"></i>
        </div>
        <div class="error-code">404</div>
        <h1 class="error-title">Sayfa Bulunamadı</h1>
        <p class="error-message">
            Üzgünüz! Aradığınız sayfa mevcut değil, taşınmış veya silinmiş olabilir.
            Lütfen URL'yi kontrol edin veya aşağıdaki linkleri kullanarak devam edin.
        </p>

        @if(isset($_SERVER['REQUEST_URI']))
        <div class="error-url">
            <strong>Erişmeye Çalıştığınız URL:</strong><br>
            {{ $_SERVER['REQUEST_URI'] }}
        </div>
        @endif

        <div class="error-actions">
            <a href="{{ route('home') }}" class="btn btn-primary">
                <i class="fas fa-home"></i>
                Ana Sayfaya Dön
            </a>
            <a href="javascript:history.back()" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Geri Dön
            </a>
        </div>

        <div class="quick-links">
            <h3>Hızlı Bağlantılar</h3>
            <div class="links-grid">
                <a href="{{ route('home') }}" class="quick-link-item">
                    <i class="fas fa-home"></i>
                    <span>Ana Sayfa</span>
                </a>
                <a href="{{ route('about') }}" class="quick-link-item">
                    <i class="fas fa-info-circle"></i>
                    <span>Hakkımızda</span>
                </a>
                <a href="{{ route('projects') }}" class="quick-link-item">
                    <i class="fas fa-project-diagram"></i>
                    <span>Projelerimiz</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
