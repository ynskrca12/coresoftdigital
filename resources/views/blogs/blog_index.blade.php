@extends('layouts.master')

@section('title', 'Blog - CoreSoft Digital')
@section('meta_description', 'Yazılım, teknoloji ve dijital dönüşüm konularında en güncel içerikler CoreSoft Digital Blog’da.')
@section('meta_keywords', 'yazılım blogu, teknoloji haberleri, dijital dönüşüm, web geliştirme, mobil uygulama')

@section('styles')
<style>
    .blog-hero {
        padding: 8rem 5% 5rem;
        text-align: center;
    }

    .blog-hero h1 {
        font-size: 4rem;
        font-weight: 800;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1.5rem;
    }

    .blog-hero p {
        font-size: 1.5rem;
        color: rgba(248, 250, 252, 0.7);
        max-width: 800px;
        margin: 0 auto 2rem;
    }

    .filter-tabs {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 0.8rem 2rem;
        border-radius: 50px;
        border: 2px solid rgba(255,255,255,0.2);
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

    .blogs-container {
        padding: 5rem 5%;
    }

    .blogs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 2.5rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .blog-card {
        background: rgba(30,41,59,0.5);
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.1);
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        display: flex;
        flex-direction: column;
        height: 100%;
        cursor: pointer;
    }

    .blog-card:hover {
        transform: translateY(-10px);
        border-color: var(--accent);
        box-shadow: 0 20px 40px rgba(6,182,212,0.3);
    }

    .blog-image {
        height: 250px;
        overflow: hidden;
        position: relative;
    }

    .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .blog-card:hover .blog-image img {
        transform: scale(1.1);
    }

    .blog-content {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .blog-category {
        color: var(--accent);
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .blog-content h3 {
        font-size: 1.6rem;
        color: white;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .blog-description {
        color: rgba(248,250,252,0.7);
        line-height: 1.7;
        margin-bottom: 1.5rem;
        flex-grow: 1;
    }

    .blog-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .author-info {
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .author-avatar {
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

    .author-name {
        font-size: 0.9rem;
        color: rgba(255,255,255,0.8);
    }

    .read-btn {
        padding: 0.6rem 1.5rem;
        background: var(--gradient);
        color: white;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .read-btn:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(37,99,235,0.4);
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 4rem;
    }

    .pagination-wrapper .pagination {
        display: flex;
        gap: 0.5rem;
        list-style: none;
    }

    .pagination-wrapper .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 45px;
        height: 45px;
        background: rgba(30,41,59,0.5);
        border-radius: 8px;
        border: 1px solid rgba(255,255,255,0.1);
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .pagination-wrapper .page-link:hover {
        background: rgba(37,99,235,0.2);
        color: var(--accent);
    }

    .page-item.active .page-link {
        background: var(--gradient);
        color: white;
    }

    @media (max-width: 768px) {
        .blog-hero h1 {
            font-size: 2.5rem;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero -->
<section class="blog-hero">
    <h1>Blog</h1>
    <p>Teknoloji, yazılım ve dijital stratejiler üzerine güncel içerikler.</p>
    <div class="filter-tabs">
        <button class="filter-btn active" data-filter="all">Tümü</button>
        <button class="filter-btn" data-filter="tech">Teknoloji</button>
        <button class="filter-btn" data-filter="design">Tasarım</button>
        <button class="filter-btn" data-filter="business">İş Dünyası</button>
        <button class="filter-btn" data-filter="tips">İpuçları</button>
    </div>
</section>

<!-- Blog Grid -->
<section class="blogs-container">
    @if($blogs->count() > 0)
        <div class="blogs-grid">
            @foreach($blogs as $blog)
                <div class="blog-card" data-category="{{ Str::slug($blog->category) }}">
                    <div class="blog-image">
                        <img src="{{ $blog->image_url ?? asset('images/default-blog.jpg') }}" alt="{{ $blog->title }}">
                    </div>
                    <div class="blog-content">
                        <div class="blog-category">{{ $blog->category }}</div>
                        <h3>{{ $blog->title }}</h3>
                        <p class="blog-description">{{ Str::limit($blog->excerpt ?? strip_tags($blog->content), 140) }}</p>
                        <div class="blog-footer">
                            <div class="author-info">
                                <div class="author-avatar">{{ strtoupper(substr($blog->author, 0, 2)) }}</div>
                                <div class="author-name">{{ $blog->author }}<br>
                                    <small style="color:rgba(255,255,255,0.5)">{{ $blog->created_at->format('d M Y') }}</small>
                                </div>
                            </div>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="read-btn">Devamını Oku <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($blogs->hasPages())
        <div class="pagination-wrapper">
            {{ $blogs->links() }}
        </div>
        @endif
    @else
        <div class="empty-state" style="text-align:center; padding:5rem 2rem;">
            <i class="fas fa-newspaper" style="font-size:5rem; color:rgba(255,255,255,0.3); margin-bottom:1.5rem;"></i>
            <h3 style="color:rgba(255,255,255,0.8);">Henüz Blog Yazısı Eklenmemiş</h3>
            <p style="color:rgba(255,255,255,0.5);">Yakında yeni içerikler burada olacak.</p>
        </div>
    @endif
</section>
@endsection

@section('scripts')
<script>
    // Blog filter
    const buttons = document.querySelectorAll('.filter-btn');
    const blogs = document.querySelectorAll('.blog-card');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const filter = btn.dataset.filter;

            blogs.forEach(blog => {
                if (filter === 'all' || blog.dataset.category === filter) {
                    blog.style.display = 'block';
                    setTimeout(() => blog.style.opacity = '1', 10);
                } else {
                    blog.style.opacity = '0';
                    setTimeout(() => blog.style.display = 'none', 300);
                }
            });
        });
    });
</script>
@endsection
