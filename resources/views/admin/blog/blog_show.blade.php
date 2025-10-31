@extends('admin.layouts.master')

@section('title', 'Blog Önizleme - ' . $blog->title)

@section('styles')
<style>
    /* Content Header */
    .content-header {
        margin-bottom: 2rem;
    }

    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .content-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 0.5rem 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .content-title i {
        color: #3b82f6;
    }

    .content-subtitle {
        color: #64748b;
        margin: 0;
        font-size: 0.95rem;
    }

    /* Header Actions */
    .header-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-secondary {
        background: #f1f5f9;
        color: #475569;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .btn-success:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }

    .btn-info {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        color: white;
    }

    .btn-info:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);
    }

    /* Layout */
    .preview-container {
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .preview-main {
        flex: 1;
        min-width: 0;
    }

    .preview-sidebar {
        width: 320px;
    }

    /* Content Box */
    .content-box {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .sidebar-box {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .box-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 1.5rem 0;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f1f5f9;
    }

    /* Blog Preview */
    .blog-preview-header {
        margin-bottom: 2rem;
    }

    .blog-preview-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1e293b;
        line-height: 1.2;
        margin: 0 0 1rem 0;
    }

    .blog-preview-meta {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        color: #64748b;
        font-size: 0.95rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .meta-item i {
        color: #94a3b8;
    }

    /* Featured Image */
    .blog-preview-image {
        width: 100%;
        border-radius: 12px;
        margin-bottom: 2rem;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .blog-preview-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    /* Excerpt */
    .blog-preview-excerpt {
        font-size: 1.25rem;
        line-height: 1.7;
        color: #475569;
        font-style: italic;
        padding: 1.5rem;
        background: #f8fafc;
        border-left: 4px solid #3b82f6;
        border-radius: 8px;
        margin-bottom: 2rem;
    }

    /* Content */
    .blog-preview-content {
        font-size: 1.05rem;
        line-height: 1.8;
        color: #334155;
    }

    .blog-preview-content p {
        margin-bottom: 1.25rem;
    }

    .blog-preview-content h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1e293b;
        margin: 2rem 0 1rem 0;
    }

    .blog-preview-content h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1e293b;
        margin: 1.5rem 0 1rem 0;
    }

    /* Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .badge-success {
        background: #dcfce7;
        color: #16a34a;
    }

    .badge-warning {
        background: #fef3c7;
        color: #d97706;
    }

    .badge-secondary {
        background: #f1f5f9;
        color: #64748b;
    }

    .badge-info {
        background: #e0f2fe;
        color: #0284c7;
    }

    /* Info List */
    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #64748b;
        font-size: 0.9rem;
    }

    .info-value {
        color: #1e293b;
        font-weight: 500;
    }

    /* Tags */
    .tags-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .tag-item {
        background: #eff6ff;
        color: #2563eb;
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    /* Status Alert */
    .status-alert {
        padding: 1rem 1.25rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 500;
    }

    .status-alert-draft {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
    }

    .status-alert-scheduled {
        background: #dbeafe;
        color: #1e40af;
        border: 1px solid #bfdbfe;
    }

    .status-alert-published {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .preview-sidebar {
            width: 100%;
        }

        .preview-container {
            flex-direction: column;
        }
    }

    @media (max-width: 768px) {
        .header-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .blog-preview-title {
            font-size: 2rem;
        }

        .content-box {
            padding: 1.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="content-header">
    <div class="header-top">
        <div class="header-left">
            <h1 class="content-title">
                <i class="fas fa-eye"></i>
                Blog Önizleme
            </h1>
            <p class="content-subtitle">Blog yazınızın nasıl görüneceğini inceleyin</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Listeye Dön
            </a>
            <a href="{{ route('admin.blog.edit', $blog) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                Düzenle
            </a>
            <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-info" target="_blank">
                <i class="fas fa-external-link-alt"></i>
                Sitede Görüntüle
            </a>
            @if($blog->status === 'draft')
            <form action="{{ route('admin.blog.publish', $blog) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-paper-plane"></i>
                    Yayınla
                </button>
            </form>
            @endif
        </div>
    </div>
</div>

<!-- Status Alert -->
@if($blog->status === 'draft')
<div class="status-alert status-alert-draft">
    <i class="fas fa-exclamation-triangle"></i>
    <span>Bu blog yazısı <strong>taslak</strong> durumundadır ve sitede görünmez.</span>
</div>
@elseif($blog->status === 'scheduled')
<div class="status-alert status-alert-scheduled">
    <i class="fas fa-clock"></i>
    <span>Bu blog yazısı <strong>{{ $blog->formatted_published_date_time }}</strong> tarihinde yayınlanacak.</span>
</div>
@else
<div class="status-alert status-alert-published">
    <i class="fas fa-check-circle"></i>
    <span>Bu blog yazısı <strong>yayında</strong> ve sitede görünüyor.</span>
</div>
@endif

<div class="preview-container">
    <!-- Main Content -->
    <div class="preview-main">
        <div class="content-box">
            <!-- Header -->
            <div class="blog-preview-header">
                <h1 class="blog-preview-title">{{ $blog->title }}</h1>
                <div class="blog-preview-meta">
                    <div class="meta-item">
                        <i class="fas fa-user"></i>
                        <span>{{ $blog->author }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-calendar"></i>
                        <span>{{ $blog->formatted_published_date }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-clock"></i>
                        <span>{{ $blog->reading_time_text }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-eye"></i>
                        <span>{{ number_format($blog->views) }} görüntülenme</span>
                    </div>
                </div>
            </div>

            <!-- Featured Image -->
            @if($blog->image)
            <div class="blog-preview-image">
                <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}">
            </div>
            @endif

            <!-- Excerpt -->
            @if($blog->excerpt)
            <div class="blog-preview-excerpt">
                {{ $blog->excerpt }}
            </div>
            @endif

            <!-- Content -->
            <div class="blog-preview-content">
                {!! nl2br(e($blog->content)) !!}
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="preview-sidebar">
        <!-- Blog Info -->
        <div class="sidebar-box">
            <h3 class="box-title">Blog Bilgileri</h3>
            <ul class="info-list">
                <li class="info-item">
                    <span class="info-label">Durum</span>
                    <span class="badge {{ $blog->status_badge_class }}">
                        {{ $blog->status_label }}
                    </span>
                </li>
                <li class="info-item">
                    <span class="info-label">Kategori</span>
                    <span class="badge badge-info">{{ $blog->category }}</span>
                </li>
                <li class="info-item">
                    <span class="info-label">Yazar</span>
                    <span class="info-value">{{ $blog->author }}</span>
                </li>
                <li class="info-item">
                    <span class="info-label">Oluşturma</span>
                    <span class="info-value">{{ $blog->created_at->format('d.m.Y H:i') }}</span>
                </li>
                @if($blog->published_at)
                <li class="info-item">
                    <span class="info-label">Yayın Tarihi</span>
                    <span class="info-value">{{ $blog->formatted_published_date_time }}</span>
                </li>
                @endif
                <li class="info-item">
                    <span class="info-label">Görüntülenme</span>
                    <span class="info-value">{{ number_format($blog->views) }}</span>
                </li>
                <li class="info-item">
                    <span class="info-label">Okuma Süresi</span>
                    <span class="info-value">{{ $blog->reading_time }} dakika</span>
                </li>
                <li class="info-item">
                    <span class="info-label">Öne Çıkan</span>
                    <span class="info-value">
                        @if($blog->featured)
                            <i class="fas fa-check-circle" style="color: #10b981;"></i> Evet
                        @else
                            <i class="fas fa-times-circle" style="color: #94a3b8;"></i> Hayır
                        @endif
                    </span>
                </li>
                <li class="info-item">
                    <span class="info-label">Aktif</span>
                    <span class="info-value">
                        @if($blog->active)
                            <i class="fas fa-check-circle" style="color: #10b981;"></i> Evet
                        @else
                            <i class="fas fa-times-circle" style="color: #ef4444;"></i> Hayır
                        @endif
                    </span>
                </li>
            </ul>
        </div>

        <!-- Tags -->
        @if($blog->tags && count($blog->tags) > 0)
        <div class="sidebar-box">
            <h3 class="box-title">Etiketler</h3>
            <div class="tags-list">
                @foreach($blog->tags as $tag)
                    <span class="tag-item">{{ $tag }}</span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- SEO Info -->
        @if($blog->meta_title || $blog->meta_description || $blog->meta_keywords)
        <div class="sidebar-box">
            <h3 class="box-title">SEO Bilgileri</h3>
            <ul class="info-list">
                @if($blog->meta_title)
                <li class="info-item" style="display: block;">
                    <span class="info-label" style="display: block; margin-bottom: 0.5rem;">Meta Başlık</span>
                    <span class="info-value" style="display: block; color: #64748b; font-size: 0.9rem;">{{ $blog->meta_title }}</span>
                </li>
                @endif
                @if($blog->meta_description)
                <li class="info-item" style="display: block;">
                    <span class="info-label" style="display: block; margin-bottom: 0.5rem;">Meta Açıklama</span>
                    <span class="info-value" style="display: block; color: #64748b; font-size: 0.9rem;">{{ $blog->meta_description }}</span>
                </li>
                @endif
                @if($blog->meta_keywords)
                <li class="info-item" style="display: block;">
                    <span class="info-label" style="display: block; margin-bottom: 0.5rem;">Anahtar Kelimeler</span>
                    <span class="info-value" style="display: block; color: #64748b; font-size: 0.9rem;">{{ $blog->meta_keywords }}</span>
                </li>
                @endif
            </ul>
        </div>
        @endif
    </div>
</div>
@endsection
