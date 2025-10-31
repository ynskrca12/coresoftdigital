@extends('admin.layouts.master')

@section('title', $project->name)

@section('styles')
<style>
    .project-header {
        background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
        padding: 3rem 2rem;
        border-radius: var(--radius);
        color: var(--white);
        margin-bottom: 2rem;
    }

    .project-header-content {
        max-width: 1200px;
        margin: 0 auto;
    }

    .project-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
    }

    .project-meta {
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
        opacity: 0.9;
    }

    .project-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .project-content {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .project-main {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .project-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .info-card {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 2rem;
    }

    .info-card-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid rgba(0, 0, 0, 0.05);
    }

    .info-card-header i {
        font-size: 1.5rem;
        color: var(--primary);
    }

    .info-card-header h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--dark);
    }

    .project-image {
        width: 100%;
        border-radius: var(--radius);
        box-shadow: var(--shadow-md);
        margin-bottom: 1.5rem;
    }

    .project-description {
        font-size: 1.05rem;
        line-height: 1.7;
        color: var(--dark);
    }

    .project-long-description {
        font-size: 1rem;
        line-height: 1.8;
        color: var(--dark-light);
        margin-top: 1rem;
    }

    .info-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        background: var(--light);
        border-radius: var(--radius-sm);
    }

    .info-label {
        font-weight: 600;
        color: var(--gray);
        font-size: 0.9rem;
    }

    .info-value {
        font-weight: 600;
        color: var(--dark);
        font-size: 0.95rem;
    }

    .status-badge-large {
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 700;
        text-align: center;
        width: 100%;
        display: block;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .quick-action-btn {
        padding: 0.875rem 1rem;
        border-radius: var(--radius-sm);
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .quick-action-btn.primary {
        background: var(--gradient);
        color: var(--white);
    }

    .quick-action-btn.primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .quick-action-btn.secondary {
        background: var(--light);
        color: var(--dark);
    }

    .quick-action-btn.secondary:hover {
        background: var(--dark-lighter);
        color: var(--white);
    }

    .quick-action-btn.danger {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }

    .quick-action-btn.danger:hover {
        background: var(--danger);
        color: var(--white);
    }

    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: var(--gray);
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    /* Activity Log */
    .activity-item {
        display: flex;
        gap: 1rem;
        padding: 1rem;
        border-left: 3px solid var(--primary);
        background: var(--light);
        border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
        margin-bottom: 0.75rem;
    }

    .activity-item:last-child {
        margin-bottom: 0;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--gradient-light);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        flex-shrink: 0;
    }

    .activity-details {
        flex: 1;
    }

    .activity-text {
        font-size: 0.9rem;
        color: var(--dark);
        margin-bottom: 0.25rem;
    }

    .activity-time {
        font-size: 0.8rem;
        color: var(--gray);
    }

    @media (max-width: 1024px) {
        .project-content {
            grid-template-columns: 1fr;
        }

        .project-sidebar {
            order: -1;
        }
    }

    @media (max-width: 768px) {
        .project-header {
            padding: 2rem 1rem;
        }

        .project-title {
            font-size: 1.75rem;
        }

        .project-meta {
            flex-direction: column;
            gap: 0.5rem;
        }

        .quick-actions {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="page-title">
        <h1>
            <i class="fas fa-eye"></i>
            Proje Detayı
        </h1>
        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Admin</a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('admin.projects.index') }}">Projeler</a>
            <i class="fas fa-chevron-right"></i>
            <span>{{ $project->name }}</span>
        </div>
    </div>
    <div class="page-actions">
        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i>
            Düzenle
        </a>
        <button class="btn btn-danger" onclick="deleteProject()">
            <i class="fas fa-trash"></i>
            Sil
        </button>
    </div>
</div>

<!-- Project Header -->
<div class="project-header fade-in">
    <div class="project-header-content">
        <h1 class="project-title">{{ $project->name }}</h1>
        <div class="project-meta">
            <div class="project-meta-item">
                <i class="fas fa-folder"></i>
                <span>{{ $project->category }}</span>
            </div>
            <div class="project-meta-item">
                <i class="fas fa-calendar"></i>
                <span>{{ $project->year }}</span>
            </div>
            <div class="project-meta-item">
                <i class="fas fa-clock"></i>
                <span>{{ $project->duration }}</span>
            </div>
            <div class="project-meta-item">
                <i class="fas fa-tag"></i>
                <span>{{ $project->status_label }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Project Content -->
<div class="project-content fade-in">
    <!-- Main Content -->
    <div class="project-main">
        <!-- Image -->
        @if($project->image)
            <div class="info-card">
                <img src="{{ $project->image_url }}" alt="{{ $project->name }}" class="project-image">
            </div>
        @endif

        <!-- Description -->
        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-align-left"></i>
                <h3>Proje Açıklaması</h3>
            </div>
            <div class="project-description">
                {{ $project->description }}
            </div>
            @if($project->long_description)
                <div class="project-long-description">
                    {{ $project->long_description }}
                </div>
            @endif
        </div>

        <!-- Project URL -->
        @if($project->url)
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-link"></i>
                    <h3>Proje Linki</h3>
                </div>
                <a href="{{ $project->url }}" target="_blank" class="quick-action-btn primary" style="width: 100%;">
                    <i class="fas fa-external-link-alt"></i>
                    Projeyi Ziyaret Et
                </a>
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="project-sidebar">
        <!-- Status -->
        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-info-circle"></i>
                <h3>Durum</h3>
            </div>
            <span class="badge status-badge-large {{ $project->status_badge_class }}">
                {{ $project->status_label }}
            </span>
        </div>

        <!-- Project Info -->
        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-list"></i>
                <h3>Proje Bilgileri</h3>
            </div>
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
                    <span class="info-label">Sıralama</span>
                    <span class="info-value">{{ $project->order }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Aktif</span>
                    <span class="info-value">
                        @if($project->active)
                            <i class="fas fa-check-circle" style="color: var(--success);"></i> Evet
                        @else
                            <i class="fas fa-times-circle" style="color: var(--danger);"></i> Hayır
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-bolt"></i>
                <h3>Hızlı İşlemler</h3>
            </div>
            <div class="quick-actions">
                <a href="{{ route('admin.projects.edit', $project) }}" class="quick-action-btn primary">
                    <i class="fas fa-edit"></i>
                    Düzenle
                </a>
                <button onclick="toggleStatus()" class="quick-action-btn secondary">
                    <i class="fas fa-toggle-on"></i>
                    {{ $project->active ? 'Pasif Et' : 'Aktif Et' }}
                </button>
                <a href="{{ route('admin.projects.index') }}" class="quick-action-btn secondary">
                    <i class="fas fa-list"></i>
                    Liste
                </a>
                <button onclick="deleteProject()" class="quick-action-btn danger">
                    <i class="fas fa-trash"></i>
                    Sil
                </button>
            </div>
        </div>

        <!-- Timestamps -->
        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-clock"></i>
                <h3>Zaman Bilgisi</h3>
            </div>
            <div class="info-list">
                <div class="info-item">
                    <span class="info-label">Oluşturulma</span>
                    <span class="info-value">{{ $project->created_at->format('d.m.Y H:i') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Son Güncelleme</span>
                    <span class="info-value">{{ $project->updated_at->format('d.m.Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form (Hidden) -->
<form id="deleteForm" action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script>
    // Delete project
    function deleteProject() {
        if (confirm('Bu projeyi silmek istediğinizden emin misiniz?\n\nBu işlem geri alınamaz!')) {
            document.getElementById('deleteForm').submit();
        }
    }

    // Toggle status
    function toggleStatus() {
        if (confirm('Proje durumunu değiştirmek istediğinizden emin misiniz?')) {
            fetch('{{ route("admin.projects.toggle-status", $project) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
        }
    }
</script>
@endsection
