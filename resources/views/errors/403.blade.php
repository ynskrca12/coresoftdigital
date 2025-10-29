@extends('layouts.master')

@section('title', '403 - Erişim Yasak')

@section('meta_description', 'Bu sayfaya erişim yetkiniz bulunmamaktadır.')

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
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
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
        color: #f59e0b;
        animation: pulse 2s ease-in-out infinite;
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
            <i class="fas fa-lock"></i>
        </div>
        <div class="error-code">403</div>
        <h1 class="error-title">Erişim Yasak</h1>
        <p class="error-message">
            Bu sayfaya erişim yetkiniz bulunmamaktadır.
            Yönetici girişi gerekebilir veya bu sayfa size özel olmayabilir.
        </p>

        <div class="error-actions">
            <a href="{{ route('home') }}" class="btn btn-primary">
                <i class="fas fa-home"></i>
                Ana Sayfaya Dön
            </a>
            <a href="{{ route('contact') }}" class="btn btn-secondary">
                <i class="fas fa-question-circle"></i>
                Yardım İsteyin
            </a>
        </div>
    </div>
</div>
@endsection
