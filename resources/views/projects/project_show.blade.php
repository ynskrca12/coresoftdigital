@extends('layouts.master')

@section('title', $project->name . ' - CoreSoft Digital')

@section('meta_description', Str::limit($project->description, 160))

@section('styles')
<style>
    /* Project Hero */
    .project-hero {
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 8rem 5% 5rem;
        background: linear-gradient(135deg, rgba(30, 41, 59, 0.95) 0%, rgba(17, 24, 39, 0.95) 100%);
    }

    .project-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('{{ $project->image_url }}') center/cover;
        opacity: 0.1;
        filter: blur(10px);
    }

    .project-hero-content {
        max-width: 1200px;
        width: 100%;
        z-index: 1;
        text-align: center;
    }

    .project-category-badge {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        background: var(--gradient-light);
        color: var(--primary);
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .project-hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #fff 0%, var(--accent) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1.2;
    }

    .project-hero-description {
        font-size: 1.3rem;
        color: rgba(248, 250, 252, 0.8);
        max-width: 800px;
        margin: 0 auto 2rem;
        line-height: 1.8;
    }

    .project-meta {
        display: flex;
        gap: 3rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 2rem;
    }

    .meta-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
    }

    .meta-item i {
        font-size: 2rem;
        color: var(--accent);
    }

    .meta-label {
        font-size: 0.85rem;
        color: rgba(248, 250, 252, 0.6);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .meta-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--light);
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
    }

    /* Project Content */
    .project-content-section {
        padding: 5rem 5%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 4rem;
        margin-top: 3rem;
    }

    .main-content {
        display: flex;
        flex-direction: column;
        gap: 3rem;
    }

    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    /* Content Card */
    .content-card {
        background: rgba(30, 41, 59, 0.5);
        border-radius: 20px;
        padding: 2.5rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }

    .content-card h2 {
        font-size: 2rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .content-card h2 i {
        color: var(--accent);
    }

    .content-card p, .content-card li {
        color: rgba(248, 250, 252, 0.8);
        line-height: 1.8;
        font-size: 1.05rem;
    }

    .content-card ul {
        list-style: none;
        padding: 0;
    }

    .content-card li {
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .content-card li:last-child {
        border-bottom: none;
    }

    .content-card li i {
        color: var(--accent);
        margin-right: 1rem;
        width: 20px;
    }

    /* Project Image */
    .project-image-card {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .project-image-card img {
        width: 100%;
        height: auto;
        display: block;
    }

    /* Info List */
    .info-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: rgba(255, 255, 255, 0.05);
        transform: translateX(5px);
    }

    .info-label {
        font-size: 0.9rem;
        color: rgba(248, 250, 252, 0.6);
        font-weight: 600;
    }

    .info-value {
        font-size: 1rem;
        color: var(--light);
        font-weight: 600;
    }

    /* Action Button */
    .action-btn {
        width: 100%;
        padding: 1.25rem;
        background: var(--gradient);
        color: white;
        border: none;
        border-radius: 15px;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        text-decoration: none;
    }

    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(37, 99, 235, 0.5);
    }

    .action-btn-outline {
        background: transparent;
        border: 2px solid rgba(255, 255, 255, 0.2);
        color: var(--light);
    }

    .action-btn-outline:hover {
        border-color: var(--accent);
        background: rgba(6, 182, 212, 0.1);
        box-shadow: none;
    }

    /* Related Projects */
    .related-section {
        padding: 5rem 5%;
        background: rgba(30, 41, 59, 0.3);
    }

    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-header h2 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
    }

    .section-header p {
        font-size: 1.1rem;
        color: rgba(248, 250, 252, 0.7);
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .related-card {
        background: rgba(30, 41, 59, 0.5);
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .related-card:hover {
        transform: translateY(-10px);
        border-color: var(--accent);
        box-shadow: 0 20px 40px rgba(6, 182, 212, 0.2);
    }

    .related-image {
        height: 200px;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .related-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .related-image i {
        font-size: 4rem;
        color: white;
        position: relative;
        z-index: 1;
    }

    .related-content {
        padding: 1.5rem;
    }

    .related-content h3 {
        font-size: 1.3rem;
        margin-bottom: 0.75rem;
    }

    .related-content p {
        color: rgba(248, 250, 252, 0.7);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }

        .sidebar {
            order: -1;
        }
    }

    @media (max-width: 768px) {
        .project-hero {
            padding: 6rem 5% 4rem;
        }

        .project-hero h1 {
            font-size: 2.5rem;
        }

        .project-hero-description {
            font-size: 1.1rem;
        }

        .project-meta {
            gap: 1.5rem;
        }

        .content-card {
            padding: 1.5rem;
        }

        .related-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<!-- Project Hero -->
<section class="project-hero">
    <div class="project-hero-content">
        <div class="project-category-badge">{{ $project->category }}</div>
        <h1>{{ $project->name }}</h1>
        <p class="project-hero-description">{{ $project->description }}</p>

        <div class="project-meta">
            <div class="meta-item">
                <i class="fas fa-calendar"></i>
                <span class="meta-label">Yıl</span>
                <span class="meta-value">{{ $project->year }}</span>
            </div>
            <div class="meta-item">
                <i class="fas fa-clock"></i>
                <span class="meta-label">Süre</span>
                <span class="meta-value">{{ $project->duration }}</span>
            </div>
            <div class="meta-item">
                <i class="fas fa-{{ $project->status == 'completed' ? 'check-circle' : ($project->status == 'in_progress' ? 'spinner' : 'pause-circle') }}"></i>
                <span class="meta-label">Durum</span>
                <span class="meta-value">
                    <span class="status-badge badge {{ $project->status_badge_class }}">
                        {{ $project->status_label }}
                    </span>
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Project Content -->
<section class="project-content-section">
    <div class="content-grid">
        <!-- Main Content -->
        <div class="main-content">
            <!-- Project Image -->
            @if($project->image)
                <div class="project-image-card">
                    <img src="{{ $project->image_url }}" alt="{{ $project->name }}">
                </div>
            @endif

            <!-- Description -->
            <div class="content-card">
                <h2>
                    <i class="fas fa-align-left"></i>
                    Proje Hakkında
                </h2>
                <p>{{ $project->description }}</p>

                @if($project->long_description)
                    <p style="margin-top: 1.5rem;">{{ $project->long_description }}</p>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Project Info -->
            <div class="content-card">
                <h2 style="font-size: 1.5rem;">
                    <i class="fas fa-info-circle"></i>
                    Proje Bilgileri
                </h2>
                <div class="info-list">
                    <div class="info-item">
                        <span class="info-label">Kategori</span>
                        <span class="info-value">{{ $project->category }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Yıl</span>
                        <span class="info-value">{{ $project->year }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Süre</span>
                        <span class="info-value">{{ $project->duration }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Durum</span>
                        <span class="info-value">
                            <span class="badge {{ $project->status_badge_class }}">
                                {{ $project->status_label }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Project URL -->
            @if($project->url)
                <a href="{{ $project->url }}" target="_blank" class="action-btn">
                    <i class="fas fa-external-link-alt"></i>
                    Projeyi Ziyaret Et
                </a>
            @endif

            <!-- Back Button -->
            <a href="{{ route('projects') }}" class="action-btn action-btn-outline">
                <i class="fas fa-arrow-left"></i>
                Tüm Projeler
            </a>

            <!-- Contact CTA -->
            <div class="content-card" style="background: var(--gradient-light); border-color: var(--primary);">
                <h2 style="font-size: 1.3rem; color: var(--primary); margin-bottom: 1rem;">
                    <i class="fas fa-rocket"></i>
                    Benzer Bir Proje?
                </h2>
                <p style="color: var(--dark); margin-bottom: 1.5rem;">
                    Sizin için de benzer bir proje geliştirebiliriz. Hemen iletişime geçin!
                </p>
                <a href="{{ route('contact') }}" class="action-btn" style="background: var(--gradient);">
                    <i class="fas fa-paper-plane"></i>
                    İletişime Geçin
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Related Projects -->
@if($relatedProjects && $relatedProjects->count() > 0)
    <section class="related-section">
        <div class="section-header">
            <h2>Benzer Projeler</h2>
            <p>Aynı kategorideki diğer projelerimiz</p>
        </div>
        <div class="related-grid">
            @foreach($relatedProjects as $related)
                <a href="{{ route('projects.show', $related->slug) }}" class="related-card">
                    <div class="related-image">
                        @if($related->image)
                            <img src="{{ $related->image_url }}" alt="{{ $related->name }}">
                        @else
                            <i class="fas fa-project-diagram"></i>
                        @endif
                    </div>
                    <div class="related-content">
                        <div style="color: var(--accent); font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">
                            {{ $related->category }}
                        </div>
                        <h3>{{ $related->name }}</h3>
                        <p>{{ Str::limit($related->description, 100) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endif

<!-- CTA Section -->
<section class="cta-section" style="padding: 5rem 5%; text-align: center; background: rgba(30, 41, 59, 0.3);">
    <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: 2.5rem; margin-bottom: 1rem;">Projenizi Hayata Geçirelim</h2>
        <p style="font-size: 1.2rem; color: rgba(248, 250, 252, 0.7); margin-bottom: 2rem;">
            Sizin için de harika bir proje geliştirebiliriz. Ücretsiz görüşme için hemen iletişime geçin.
        </p>
        <a href="{{ route('contact') }}" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 0.75rem; padding: 1.25rem 3rem; background: var(--gradient); color: white; border-radius: 50px; font-weight: 700; font-size: 1.1rem; text-decoration: none; transition: all 0.3s ease;">
            <i class="fas fa-paper-plane"></i>
            Ücretsiz Teklif Alın
        </a>
    </div>
</section>
@endsection
