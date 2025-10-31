@extends('admin.layouts.master')

@section('title', 'Projeler')

@section('styles')
<style>
    /* Filter Bar */
    .filter-bar {
        background: var(--white);
        padding: 1.5rem;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        margin-bottom: 1.5rem;
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-group {
        flex: 1;
        min-width: 200px;
    }

    .filter-group label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--gray);
        margin-bottom: 0.5rem;
    }

    .filter-group select,
    .filter-group input {
        width: 100%;
        padding: 0.625rem 1rem;
        border: 2px solid rgba(0, 0, 0, 0.1);
        border-radius: var(--radius-sm);
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .filter-group select:focus,
    .filter-group input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    /* Table */
    .projects-table {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }

    .table-header {
        padding: 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .table-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark);
    }

    .table-actions {
        display: flex;
        gap: 0.5rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: var(--light);
    }

    th {
        padding: 1rem 1.5rem;
        text-align: left;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid rgba(0, 0, 0, 0.05);
        white-space: nowrap;
    }

    td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        color: var(--dark);
        font-size: 0.9rem;
    }

    tbody tr {
        transition: background 0.2s;
    }

    tbody tr:hover {
        background: var(--light);
    }

    .project-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .project-image {
        width: 60px;
        height: 60px;
        border-radius: var(--radius-sm);
        object-fit: cover;
        flex-shrink: 0;
    }

    .project-details h4 {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.25rem;
    }

    .project-details p {
        font-size: 0.85rem;
        color: var(--gray);
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-sm);
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.9rem;
    }

    .action-btn.view {
        background: rgba(59, 130, 246, 0.1);
        color: var(--info);
    }

    .action-btn.view:hover {
        background: var(--info);
        color: var(--white);
    }

    .action-btn.edit {
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }

    .action-btn.edit:hover {
        background: var(--warning);
        color: var(--white);
    }

    .action-btn.delete {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }

    .action-btn.delete:hover {
        background: var(--danger);
        color: var(--white);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--gray-light);
        margin-bottom: 1rem;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .empty-text {
        color: var(--gray);
        margin-bottom: 2rem;
    }

    /* Pagination */
    .pagination-wrapper {
        padding: 1.5rem;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .pagination {
        display: flex;
        gap: 0.5rem;
    }

    .pagination a,
    .pagination span {
        padding: 0.5rem 0.75rem;
        border-radius: var(--radius-sm);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s;
    }

    .pagination a {
        background: var(--light);
        color: var(--dark);
    }

    .pagination a:hover {
        background: var(--primary);
        color: var(--white);
    }

    .pagination .active {
        background: var(--primary);
        color: var(--white);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .filter-bar {
            flex-direction: column;
        }

        .filter-group {
            width: 100%;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            min-width: 800px;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="page-title">
        <h1>
            <i class="fas fa-project-diagram"></i>
            Projeler
        </h1>
        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Admin</a>
            <i class="fas fa-chevron-right"></i>
            <span>Projeler</span>
        </div>
    </div>
    <div class="page-actions">
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Yeni Proje
        </a>
    </div>
</div>

<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success fade-in">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<!-- Filter Bar -->
<div class="filter-bar fade-in">
    <form method="GET" action="{{ route('admin.projects.index') }}" style="display: contents;">
        <div class="filter-group">
            <label for="search">Ara</label>
            <input type="text" id="search" name="search" placeholder="Proje adı, müşteri..." value="{{ request('search') }}">
        </div>

        <div class="filter-group">
            <label for="category">Kategori</label>
            <select id="category" name="category">
                <option value="">Tümü</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label for="status">Durum</label>
            <select id="status" name="status">
                <option value="">Tümü</option>
                @foreach($statuses as $key => $label)
                    <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label for="year">Yıl</label>
            <select id="year" name="year">
                <option value="">Tümü</option>
                @foreach($years as $y)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group" style="align-self: flex-end;">
            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <i class="fas fa-filter"></i>
                Filtrele
            </button>
        </div>

        <div class="filter-group" style="align-self: flex-end;">
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline" style="width: 100%;">
                <i class="fas fa-redo"></i>
                Sıfırla
            </a>
        </div>
    </form>
</div>

<!-- Projects Table -->
<div class="projects-table fade-in">
    <div class="table-header">
        <div class="table-title">
            <i class="fas fa-list"></i>
            Proje Listesi ({{ $projects->total() }})
        </div>
        @if($projects->count() > 0)
            <div class="table-actions">
                <button class="btn btn-sm btn-danger" onclick="bulkDelete()">
                    <i class="fas fa-trash"></i>
                    Toplu Sil
                </button>
            </div>
        @endif
    </div>

    @if($projects->count() > 0)
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>Proje</th>
                        <th>Kategori</th>
                        <th>Müşteri</th>
                        <th>Durum</th>
                        <th>Yıl</th>
                        <th>Ekip</th>
                        <th>Öne Çıkan</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>
                                <input type="checkbox" class="project-checkbox" value="{{ $project->id }}">
                            </td>
                            <td>
                                <div class="project-info">
                                    <img src="{{ $project->image_url }}" alt="{{ $project->name }}" class="project-image">
                                    <div class="project-details">
                                        <h4>{{ $project->name }}</h4>
                                        <p>{{ Str::limit($project->description, 50) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $project->category }}</td>
                            <td>{{ $project->customer }}</td>
                            <td>
                                <span class="badge {{ $project->status_badge_class }}">
                                    {{ $project->status_label }}
                                </span>
                            </td>
                            <td>{{ $project->year }}</td>
                            <td>{{ $project->team_size }} kişi</td>
                            <td>
                                @if($project->featured)
                                    <i class="fas fa-star" style="color: var(--warning);"></i>
                                @else
                                    <i class="far fa-star" style="color: var(--gray-light);"></i>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.projects.show', $project) }}" class="action-btn view" title="Görüntüle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="action-btn edit" title="Düzenle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="deleteProject({{ $project->id }})" class="action-btn delete" title="Sil">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            <div>
                Gösterilen: {{ $projects->firstItem() }}-{{ $projects->lastItem() }} / {{ $projects->total() }}
            </div>
            <div class="pagination">
                {{ $projects->links() }}
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-folder-open"></i>
            </div>
            <h3 class="empty-title">Henüz proje yok</h3>
            <p class="empty-text">İlk projenizi oluşturmak için butona tıklayın.</p>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                İlk Projeyi Oluştur
            </a>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Select All
    document.getElementById('selectAll')?.addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.project-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Delete Project
    function deleteProject(id) {
        if (!confirm('Bu projeyi silmek istediğinizden emin misiniz?')) {
            return;
        }

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/projects/${id}`;
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    }

    // Bulk Delete
    function bulkDelete() {
        const checkboxes = document.querySelectorAll('.project-checkbox:checked');
        if (checkboxes.length === 0) {
            alert('Lütfen silmek için en az bir proje seçin.');
            return;
        }

        if (!confirm(`${checkboxes.length} projeyi silmek istediğinizden emin misiniz?`)) {
            return;
        }

        const ids = Array.from(checkboxes).map(cb => cb.value);

        fetch('{{ route("admin.projects.bulk-delete") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ ids })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        });
    }
</script>
@endsection
