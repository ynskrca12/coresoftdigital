@extends('admin.layouts.master')

@section('title', 'Projeyi Düzenle')

@section('styles')
<style>
    .form-container {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 2rem;
    }

    .form-section {
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .form-section-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        color: var(--dark);
        font-size: 1.2rem;
        font-weight: 700;
    }

    .form-section-header i {
        color: var(--primary);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .form-group label .required {
        color: var(--danger);
    }

    .form-group .help-text {
        font-size: 0.85rem;
        color: var(--gray);
        margin-top: 0.25rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid rgba(0, 0, 0, 0.1);
        border-radius: var(--radius-sm);
        font-size: 0.95rem;
        transition: all 0.2s;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-control.error {
        border-color: var(--danger);
    }

    .error-message {
        color: var(--danger);
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    /* Image Upload */
    .image-upload-area {
        border: 2px dashed rgba(0, 0, 0, 0.1);
        border-radius: var(--radius);
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .image-upload-area:hover {
        border-color: var(--primary);
        background: var(--light);
    }

    .image-upload-area input {
        display: none;
    }

    .current-image {
        max-width: 300px;
        margin: 1rem auto;
        border-radius: var(--radius-sm);
        box-shadow: var(--shadow-sm);
    }

    .image-preview {
        max-width: 300px;
        margin: 1rem auto;
        border-radius: var(--radius-sm);
        display: none;
    }

    .remove-image-btn {
        display: inline-block;
        margin-top: 0.5rem;
        padding: 0.5rem 1rem;
        background: var(--danger);
        color: var(--white);
        border: none;
        border-radius: var(--radius-sm);
        cursor: pointer;
        font-size: 0.85rem;
    }

    /* Status Select */
    .status-select {
        display: flex;
        gap: 1rem;
    }

    .status-option {
        flex: 1;
        position: relative;
    }

    .status-option input[type="radio"] {
        display: none;
    }

    .status-option label {
        display: block;
        padding: 1rem;
        border: 2px solid rgba(0, 0, 0, 0.1);
        border-radius: var(--radius-sm);
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .status-option input[type="radio"]:checked + label {
        border-color: var(--primary);
        background: var(--gradient-light);
        color: var(--primary);
    }

    .status-option label:hover {
        border-color: var(--primary);
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid rgba(0, 0, 0, 0.05);
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .status-select {
            flex-direction: column;
        }

        .form-actions {
            flex-direction: column;
        }

        .form-actions .btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="page-title">
        <h1>
            <i class="fas fa-edit"></i>
            Projeyi Düzenle
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
        <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-outline">
            <i class="fas fa-eye"></i>
            Görüntüle
        </a>
    </div>
</div>

<!-- Form -->
<div class="form-container fade-in">
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Basic Info -->
        <div class="form-section">
            <div class="form-section-header">
                <i class="fas fa-info-circle"></i>
                Temel Bilgiler
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="name">Proje Adı <span class="required">*</span></label>
                    <input type="text" id="name" name="name" class="form-control @error('name') error @enderror"
                           value="{{ old('name', $project->name) }}" required>
                    @error('name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" id="slug" name="slug" class="form-control @error('slug') error @enderror"
                           value="{{ old('slug', $project->slug) }}">
                    <div class="help-text">URL için kullanılır. Boş bırakılırsa otomatik oluşturulur.</div>
                    @error('slug')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="category">Kategori <span class="required">*</span></label>
                    <select id="category" name="category" class="form-control @error('category') error @enderror" required>
                        <option value="">Kategori Seçin</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category', $project->category) == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">Proje URL</label>
                    <input type="url" id="url" name="url" class="form-control @error('url') error @enderror"
                           value="{{ old('url', $project->url) }}" placeholder="https://example.com">
                    @error('url')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description">Kısa Açıklama <span class="required">*</span></label>
                <textarea id="description" name="description" class="form-control @error('description') error @enderror" required>{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="long_description">Detaylı Açıklama</label>
                <textarea id="long_description" name="long_description" class="form-control" style="min-height: 200px;">{{ old('long_description', $project->long_description) }}</textarea>
                <div class="help-text">Proje hakkında detaylı bilgi.</div>
            </div>
        </div>

        <!-- Project Details -->
        <div class="form-section">
            <div class="form-section-header">
                <i class="fas fa-cogs"></i>
                Proje Detayları
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="duration">Proje Süresi <span class="required">*</span></label>
                    <input type="text" id="duration" name="duration" class="form-control @error('duration') error @enderror"
                           value="{{ old('duration', $project->duration) }}" placeholder="Örn: 6 Ay" required>
                    @error('duration')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="year">Yıl <span class="required">*</span></label>
                    <input type="number" id="year" name="year" class="form-control @error('year') error @enderror"
                           value="{{ old('year', $project->year) }}" min="2020" max="2030" required>
                    @error('year')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="order">Sıralama</label>
                    <input type="number" id="order" name="order" class="form-control @error('order') error @enderror"
                           value="{{ old('order', $project->order) }}" min="0">
                    <div class="help-text">Düşük numara önce gösterilir.</div>
                    @error('order')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Durum <span class="required">*</span></label>
                <div class="status-select">
                    @foreach($statuses as $key => $label)
                        <div class="status-option">
                            <input type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}"
                                   {{ old('status', $project->status) == $key ? 'checked' : '' }} required>
                            <label for="status_{{ $key }}">
                                <strong>{{ $label }}</strong>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('status')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Image -->
        <div class="form-section">
            <div class="form-section-header">
                <i class="fas fa-image"></i>
                Proje Görseli
            </div>

            @if($project->image)
                <div class="form-group">
                    <label>Mevcut Görsel</label>
                    <img src="{{ $project->image_url }}" alt="{{ $project->name }}" class="current-image" id="currentImage">
                    <div style="text-align: center;">
                        <button type="button" class="remove-image-btn" onclick="removeCurrentImage()">
                            <i class="fas fa-trash"></i>
                            Mevcut Görseli Kaldır
                        </button>
                    </div>
                </div>
            @endif

            <div class="form-group">
                <label>{{ $project->image ? 'Yeni Görsel Yükle' : 'Görsel Yükle' }}</label>
                <label class="image-upload-area" for="image">
                    <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; color: var(--primary);"></i>
                    <p style="margin: 1rem 0 0; color: var(--gray);">Resim yüklemek için tıklayın</p>
                    <small style="color: var(--gray-light);">JPG, PNG, WEBP (Max: 2MB)</small>
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                </label>
                <img id="imagePreview" class="image-preview" alt="Preview">
                @error('image')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Değişiklikleri Kaydet
            </button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline">
                <i class="fas fa-times"></i>
                İptal
            </a>
            <button type="button" class="btn btn-danger" onclick="deleteProject()" style="margin-left: auto;">
                <i class="fas fa-trash"></i>
                Projeyi Sil
            </button>
        </div>
    </form>
</div>

<!-- Delete Form (Hidden) -->
<form id="deleteForm" action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script>
    // Image Preview
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const currentImage = document.getElementById('currentImage');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                if (currentImage) {
                    currentImage.style.opacity = '0.5';
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Remove current image
    function removeCurrentImage() {
        if (confirm('Mevcut görseli kaldırmak istediğinizden emin misiniz?')) {
            const currentImage = document.getElementById('currentImage');
            if (currentImage) {
                currentImage.style.display = 'none';
            }
            // You might want to send an AJAX request to remove the image from server
        }
    }

    // Auto-generate slug from name (optional - only if slug is empty)
    document.getElementById('name').addEventListener('input', function() {
        const slug = document.getElementById('slug');
        const originalSlug = '{{ $project->slug }}';

        // Only auto-generate if slug hasn't been manually changed
        if (slug.value === originalSlug || slug.value === '') {
            slug.value = this.value
                .toLowerCase()
                .replace(/ğ/g, 'g')
                .replace(/ü/g, 'u')
                .replace(/ş/g, 's')
                .replace(/ı/g, 'i')
                .replace(/ö/g, 'o')
                .replace(/ç/g, 'c')
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-|-$/g, '');
        }
    });

    // Delete project
    function deleteProject() {
        if (confirm('Bu projeyi silmek istediğinizden emin misiniz?\n\nBu işlem geri alınamaz!')) {
            document.getElementById('deleteForm').submit();
        }
    }

    // Warn before leaving if form is dirty
    let formChanged = false;
    document.querySelector('form').addEventListener('change', function() {
        formChanged = true;
    });

    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    // Don't warn on submit
    document.querySelector('form').addEventListener('submit', function() {
        formChanged = false;
    });
</script>
@endsection
