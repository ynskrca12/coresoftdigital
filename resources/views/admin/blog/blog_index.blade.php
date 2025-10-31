@extends('admin.layouts.master')

@section('title', 'Blog Yönetimi')

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

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: white;
    }

    .stat-icon.bg-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    .stat-icon.bg-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .stat-icon.bg-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .stat-icon.bg-info {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
    }

    .stat-content {
        flex: 1;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        color: #64748b;
        font-weight: 500;
    }

    /* Content Box */
    .content-box {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    /* Filters */
    .filters-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .filter-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0.5rem;
    }

    .filter-group label i {
        margin-right: 0.35rem;
        color: #94a3b8;
    }

    .form-control {
        width: 100%;
        padding: 0.625rem 0.875rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.2s;
        background: white;
    }

    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .filters-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.25rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    .btn-secondary {
        background: #f1f5f9;
        color: #475569;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
    }

    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .btn-danger:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }

    /* Table */
    .table-responsive {
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead {
        background: #f8fafc;
        border-bottom: 2px solid #e2e8f0;
    }

    .data-table th {
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.85rem;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .data-table td {
        padding: 1rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .data-table tbody tr:hover {
        background: #f8fafc;
    }

    .table-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        overflow: hidden;
        background: #f1f5f9;
    }

    .table-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .table-cell-content strong {
        display: block;
        color: #1e293b;
        margin-bottom: 0.25rem;
        font-size: 0.95rem;
    }

    .text-muted {
        color: #94a3b8;
    }

    .text-small, .small {
        font-size: 0.85rem;
    }

    /* Badge */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-size: 0.8rem;
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

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        color: white;
        text-decoration: none;
        font-size: 0.9rem;
        background: transparent;
    }

    .btn-action.btn-info {
        background: #06b6d4;
    }

    .btn-action.btn-info:hover {
        background: #0891b2;
        transform: translateY(-2px);
    }

    .btn-action.btn-primary {
        background: #3b82f6;
    }

    .btn-action.btn-primary:hover {
        background: #2563eb;
        transform: translateY(-2px);
    }

    .btn-action.btn-success {
        background: #10b981;
    }

    .btn-action.btn-success:hover {
        background: #059669;
        transform: translateY(-2px);
    }

    .btn-action.btn-danger {
        background: #ef4444;
    }

    .btn-action.btn-danger:hover {
        background: #dc2626;
        transform: translateY(-2px);
    }

    .delete-form {
        display: inline;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
    }

    .empty-state i {
        color: #cbd5e1;
        margin-bottom: 1rem;
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f1f5f9;
    }

    /* Checkbox */
    input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #3b82f6;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .header-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .filters-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-wrap: wrap;
        }
    }
</style>
@endsection

@section('content')
<div class="content-header">
    <div class="header-top">
        <div class="header-left">
            <h1 class="content-title">
                <i class="fas fa-blog"></i>
                Blog Yönetimi
            </h1>
            <p class="content-subtitle">Blog yazılarını yönetin ve yeni yazılar ekleyin</p>
        </div>
        <div class="header-right">
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Yeni Blog Ekle
            </a>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon bg-primary">
            <i class="fas fa-newspaper"></i>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['total'] }}</div>
            <div class="stat-label">Toplam Blog</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-success">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['published'] }}</div>
            <div class="stat-label">Yayında</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-warning">
            <i class="fas fa-edit"></i>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['draft'] }}</div>
            <div class="stat-label">Taslak</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-info">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['scheduled'] }}</div>
            <div class="stat-label">Zamanlanmış</div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="content-box">
    <form method="GET" action="{{ route('admin.blog.index') }}" class="filters-form">
        <div class="filters-grid">
            <div class="filter-group">
                <label>
                    <i class="fas fa-search"></i>
                    Ara
                </label>
                <input type="text" name="search" placeholder="Blog başlığı, kategori..."
                       value="{{ request('search') }}" class="form-control">
            </div>
            <div class="filter-group">
                <label>
                    <i class="fas fa-folder"></i>
                    Kategori
                </label>
                <select name="category" class="form-control">
                    <option value="">Tüm Kategoriler</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label>
                    <i class="fas fa-info-circle"></i>
                    Durum
                </label>
                <select name="status" class="form-control">
                    <option value="">Tüm Durumlar</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Yayında</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Taslak</option>
                    <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Zamanlanmış</option>
                </select>
            </div>
            <div class="filter-group">
                <label>
                    <i class="fas fa-sort"></i>
                    Sırala
                </label>
                <select name="sort" class="form-control">
                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Oluşturma Tarihi</option>
                    <option value="published_at" {{ request('sort') == 'published_at' ? 'selected' : '' }}>Yayın Tarihi</option>
                    <option value="views" {{ request('sort') == 'views' ? 'selected' : '' }}>Görüntülenme</option>
                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Başlık</option>
                </select>
            </div>
        </div>
        <div class="filters-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-filter"></i>
                Filtrele
            </button>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">
                <i class="fas fa-redo"></i>
                Sıfırla
            </a>
            <button type="button" class="btn btn-danger" id="bulkDeleteBtn" style="display: none;">
                <i class="fas fa-trash"></i>
                Seçilenleri Sil (<span id="selectedCount">0</span>)
            </button>
        </div>
    </form>
</div>

<!-- Blogs Table -->
<div class="content-box">
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th width="40">
                        <input type="checkbox" id="selectAll">
                    </th>
                    <th width="80">Görsel</th>
                    <th>Başlık</th>
                    <th>Kategori</th>
                    <th>Yazar</th>
                    <th>Durum</th>
                    <th>Yayın Tarihi</th>
                    <th>Görüntülenme</th>
                    <th width="150">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                <tr>
                    <td>
                        <input type="checkbox" class="blog-checkbox" value="{{ $blog->id }}">
                    </td>
                    <td>
                        <div class="table-image">
                            <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}">
                        </div>
                    </td>
                    <td>
                        <div class="table-cell-content">
                            <strong>{{ $blog->title }}</strong>
                            @if($blog->featured)
                                <span class="badge badge-warning" style="margin-left: 0.5rem;">
                                    <i class="fas fa-star"></i> Öne Çıkan
                                </span>
                            @endif
                            <div class="text-muted small">{{ Str::limit($blog->excerpt, 60) }}</div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-info">{{ $blog->category }}</span>
                    </td>
                    <td>{{ $blog->author }}</td>
                    <td>
                        <span class="badge {{ $blog->status_badge_class }}">
                            {{ $blog->status_label }}
                        </span>
                    </td>
                    <td>
                        <div class="text-small">
                            {{ $blog->formatted_published_date_time }}
                        </div>
                    </td>
                    <td>
                        <div class="text-small">
                            <i class="fas fa-eye text-muted"></i>
                            {{ number_format($blog->views) }}
                        </div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.blog.show', $blog) }}"
                               class="btn-action btn-info"
                               title="Önizle"
                               target="_blank">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.blog.edit', $blog) }}"
                               class="btn-action btn-primary"
                               title="Düzenle">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button"
                                    class="btn-action btn-success toggle-status"
                                    data-id="{{ $blog->id }}"
                                    data-active="{{ $blog->active }}"
                                    title="{{ $blog->active ? 'Pasif Et' : 'Aktif Et' }}">
                                <i class="fas fa-{{ $blog->active ? 'toggle-on' : 'toggle-off' }}"></i>
                            </button>
                            <form action="{{ route('admin.blog.destroy', $blog) }}"
                                  method="POST"
                                  class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn-action btn-danger"
                                        title="Sil"
                                        onclick="return confirm('Bu blog yazısını silmek istediğinizden emin misiniz?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align: center; padding: 3rem 1rem;">
                        <div class="empty-state">
                            <i class="fas fa-inbox fa-3x"></i>
                            <p class="text-muted" style="margin-top: 1rem;">Henüz blog yazısı bulunmuyor.</p>
                            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                                <i class="fas fa-plus"></i>
                                İlk Blog Yazısını Ekle
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($blogs->hasPages())
    <div class="pagination-wrapper">
        {{ $blogs->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
// Select All
document.getElementById('selectAll')?.addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.blog-checkbox');
    checkboxes.forEach(cb => cb.checked = this.checked);
    updateBulkDeleteButton();
});

// Individual checkboxes
document.querySelectorAll('.blog-checkbox').forEach(cb => {
    cb.addEventListener('change', updateBulkDeleteButton);
});

function updateBulkDeleteButton() {
    const checked = document.querySelectorAll('.blog-checkbox:checked');
    const bulkBtn = document.getElementById('bulkDeleteBtn');
    const countSpan = document.getElementById('selectedCount');

    if (checked.length > 0) {
        bulkBtn.style.display = 'inline-flex';
        countSpan.textContent = checked.length;
    } else {
        bulkBtn.style.display = 'none';
    }
}

// Bulk Delete
document.getElementById('bulkDeleteBtn')?.addEventListener('click', function() {
    const checked = Array.from(document.querySelectorAll('.blog-checkbox:checked')).map(cb => cb.value);

    if (checked.length === 0) return;

    if (!confirm(`${checked.length} blog yazısını silmek istediğinizden emin misiniz?`)) return;

    fetch('{{ route("admin.blog.bulk-delete") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ ids: checked })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
});

// Toggle Status
document.querySelectorAll('.toggle-status').forEach(btn => {
    btn.addEventListener('click', function() {
        const blogId = this.dataset.id;

        fetch(`/admin/blog/${blogId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    });
});
</script>
@endpush
