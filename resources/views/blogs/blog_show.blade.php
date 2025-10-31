@extends('layouts.master')

@section('title', $blog->title . ' - CoreSoft Digital Blog')
@section('meta_description', $blog->meta_description ?? Str::limit(strip_tags($blog->excerpt), 160))

@section('content')
<section class="blog-hero">
    <div class="blog-hero-content text-center">
        <span class="blog-category-badge">{{ $blog->category }}</span>
        <h1>{{ $blog->title }}</h1>
        <p class="blog-meta">
            <i class="fas fa-user"></i> {{ $blog->author ?? 'CoreSoft Digital' }} |
            <i class="fas fa-calendar-alt"></i> {{ $blog->published_at ? $blog->published_at->format('d M Y') : 'Yakında' }}
        </p>
    </div>
</section>

<section class="blog-content-section">
    <div class="content-grid">
        <!-- Ana İçerik -->
        <div class="main-content">

            <div class="content-card">
                <h2><i class="fas fa-pen-nib"></i> Blog İçeriği</h2>
                <p class="excerpt">{{ $blog->excerpt }}</p>
                <div class="content-body">
                    {!! nl2br(e($blog->content)) !!}
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
                 @if($blog->image)
                <div class="blog-image-card">
                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
                </div>
            @endif
            <div class="content-card">
                <h3><i class="fas fa-info-circle"></i> Blog Bilgileri</h3>
                <div class="info-list">
                    <div class="info-item">
                        <span class="info-label">Kategori</span>
                        <span class="info-value">{{ $blog->category }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Yazar</span>
                        <span class="info-value">{{ $blog->author ?? 'CoreSoft Digital' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Durum</span>
                        <span class="info-value">{{ ucfirst($blog->status) }}</span>
                    </div>
                    @if($blog->published_at)
                    <div class="info-item">
                        <span class="info-label">Yayın Tarihi</span>
                        <span class="info-value">{{ $blog->published_at->format('d.m.Y') }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <a href="{{ route('blog') }}" class="action-btn action-btn-outline">
                <i class="fas fa-arrow-left"></i> Tüm Yazılar
            </a>
        </div>
    </div>
</section>

@if(isset($relatedBlogs) && $relatedBlogs->count() > 0)
<section class="related-section">
    <div class="section-header">
        <h2>Benzer Yazılar</h2>
        <p>İlginizi çekebilecek diğer içerikler</p>
    </div>
    <div class="related-grid">
        @foreach($relatedBlogs as $related)
            <a href="{{ route('blog.show', $related->slug) }}" class="related-card">
                <div class="related-image">
                    @if($related->image)
                        <img src="{{ asset($related->image) }}" alt="{{ $related->title }}">
                    @else
                        <i class="fas fa-newspaper"></i>
                    @endif
                </div>
                <div class="related-content">
                    <div class="related-category">{{ $related->category }}</div>
                    <h3>{{ $related->title }}</h3>
                    <p>{{ Str::limit(strip_tags($related->excerpt), 100) }}</p>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif

<section class="cta-section">
    <div class="cta-content">
        <h2>Blogumuza Katılın</h2>
        <p >Yeni yazılardan haberdar olun ve yazılım dünyasındaki yenilikleri kaçırmayın.</p>
        <a href="{{ route('contact') }}" class="btn-primary" style="margin-top: 15px;">
            <i class="fas fa-paper-plane"></i> Bize Ulaşın
        </a>
    </div>
</section>
@endsection

@section('styles')
<style>
:root {
    --dark-blue: #0f172a;
    --mid-blue: #1e293b;
    --accent: #3b82f6;
    --light: #f8fafc;
}

/* === HERO === */
.blog-hero {
    background: linear-gradient(135deg, var(--mid-blue), var(--dark-blue));
    padding: 8rem 5% 5rem;
    color: #fff;
    text-align: center;
}
.blog-category-badge {
    background: var(--accent);
    color: #fff;
    padding: 0.5rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.blog-hero h1 {
    font-size: 3rem;
    font-weight: 800;
    margin-top: 1.5rem;
}
.blog-meta {
    color: rgba(255,255,255,0.7);
    font-size: 0.95rem;
    margin-top: 1rem;
}

/* === CONTENT === */
.blog-content-section {
    padding: 5rem 5%;
    background: var(--dark-blue);
    color: #fff;
}
.content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
}
.content-card {
    background: rgba(255,255,255,0.05);
    padding: 2rem;
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.08);
    backdrop-filter: blur(6px);
}
.content-card h2, .content-card h3 {
    color: var(--accent);
    margin-bottom: 1.5rem;
    font-weight: 700;
}
.blog-image-card img {
    width: 400px;
    border-radius: 20px;
    margin-bottom: 2rem;
}
.excerpt {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.8);
    margin-bottom: 2rem;
}
.content-body {
    line-height: 1.8;
    color: rgba(255,255,255,0.85);
}

/* === SIDEBAR === */
.sidebar .info-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.info-item {
    display: flex;
    justify-content: space-between;
    background: rgba(255,255,255,0.05);
    padding: 1rem;
    border-radius: 12px;
}
.info-label {
    color: rgba(255,255,255,0.6);
}
.info-value {
    font-weight: 600;
}
.action-btn, .action-btn-outline {
    display: block;
    text-align: center;
    padding: 1rem;
    border-radius: 12px;
    font-weight: 700;
    margin-top: 1.5rem;
    text-decoration: none;
}
.action-btn-outline {
    border: 2px solid rgba(255,255,255,0.2);
    color: #fff;
}
.action-btn-outline:hover {
    border-color: var(--accent);
}

/* === RELATED === */
.related-section {
    background: var(--mid-blue);
    padding: 5rem 5%;
    color: #fff;
}
.section-header h2 {
    font-size: 2.2rem;
    font-weight: 800;
}
.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
}
.related-card {
    background: rgba(255,255,255,0.05);
    border-radius: 20px;
    overflow: hidden;
    text-decoration: none;
    color: #fff;
    transition: all 0.3s ease;
}
.related-card:hover {
    transform: translateY(-5px);
    border: 1px solid var(--accent);
}
.related-image {
    height: 200px;
    overflow: hidden;
}
.related-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.related-content {
    padding: 1.5rem;
}
.related-category {
    color: var(--accent);
    font-size: 0.85rem;
    margin-bottom: 0.5rem;
}

/* === CTA === */
.cta-section {
    background: var(--mid-blue);
    padding: 5rem 5%;
    text-align: center;
}
.btn-primary {
    background: var(--accent);
    color: #fff;
    padding: 1rem 2.5rem;
    border-radius: 50px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}
.btn-primary:hover {
    background: #2563eb;
    transform: translateY(-2px);
}

/* === RESPONSIVE === */
@media (max-width: 992px) {
    .content-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
