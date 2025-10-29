@extends('layouts.master')

@section('title', '500 - Sunucu Hatası')

@section('meta_description', 'Sunucu hatası oluştu. Teknik ekibimiz sorunu çözmek için çalışıyor.')

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
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
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
    }

    .error-illustration {
        margin-bottom: 1rem;
        font-size: 6rem;
        color: #ef4444;
        animation: pulse 2s ease-in-out infinite;
    }

    .error-info {
        background: rgba(239, 68, 68, 0.1);
        padding: 1.5rem;
        border-radius: 15px;
        border: 1px solid rgba(239, 68, 68, 0.3);
        margin-top: 2rem;
        text-align: left;
    }

    .error-info h4 {
        color: #ef4444;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    .error-info ul {
        list-style: none;
        padding: 0;
        color: rgba(248, 250, 252, 0.7);
    }

    .error-info li {
        padding: 0.5rem 0;
        padding-left: 1.5rem;
        position: relative;
    }

    .error-info li:before {
        content: "•";
        position: absolute;
        left: 0;
        color: #ef4444;
        font-size: 1.5rem;
        line-height: 1;
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
    }
</style>
@endsection

@section('content')
<div class="error-page">
    <div class="error-content">
        <div class="error-illustration">
            <i class="fas fa-tools"></i>
        </div>
        <div class="error-code">500</div>
        <h1 class="error-title">Sunucu Hatası</h1>
        <p class="error-message">
            Üzgünüz! Sunucumuzda beklenmeyen bir hata oluştu.
            Teknik ekibimiz sorunu çözmek için çalışıyor.
        </p>

        <div class="error-actions">
            <a href="{{ route('home') }}" class="btn btn-primary">
                <i class="fas fa-home"></i>
                Ana Sayfaya Dön
            </a>
            <a href="javascript:location.reload()" class="btn btn-secondary">
                <i class="fas fa-sync-alt"></i>
                Sayfayı Yenile
            </a>
        </div>

        <div class="error-info">
            <h4><i class="fas fa-info-circle"></i> Ne Yapabilirsiniz?</h4>
            <ul>
                <li>Birkaç dakika bekleyip tekrar deneyebilirsiniz</li>
                <li>Sayfayı yenileyebilirsiniz</li>
                <li>Ana sayfaya dönüp başka bölümleri ziyaret edebilirsiniz</li>
                <li>Sorun devam ederse bizimle iletişime geçebilirsiniz</li>
            </ul>
        </div>

        <p style="margin-top: 2rem; color: rgba(248, 250, 252, 0.5); font-size: 0.9rem;">
            Hata Kodu: 500 | Tarih: {{ date('d.m.Y H:i') }}
        </p>
    </div>
</div>
@endsection
