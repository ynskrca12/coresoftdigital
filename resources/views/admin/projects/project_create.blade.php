@extends('admin.layouts.master')

@section('title', 'Yeni Proje')

@section('styles')
<style>
    .form-container {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 2rem;
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

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid rgba(0, 0, 0, 0.1);
        border-radius: var(--radius-sm);
        font-size: 0.95rem;
        transition: all 0.2s;
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
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .checkbox-item input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--primary);
        cursor: pointer;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .image-upload {
        border: 2px dashed rgba(0, 0, 0, 0.1);
        border-radius: var(--radius);
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .image-upload:hover {
        border-color: var(--primary);
        background: var(--light);
    }

    .image-upload input {
        display: none;
    }

    .image-preview {
        max-width: 200px;
        margin: 1rem auto 0;
        border-radius: var(--radius-sm);
        display: none;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="page-title">
        <h1>
            <i class="fas fa-plus-circle"></i>
            Yeni Proje
        </h1>
        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Admin</a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('admin.projects.index') }}">Projeler</a>
            <i class="fas fa-chevron-right"></i>
            <span>Yeni Proje</span>
        </div>
    </div>
</div>

<!-- Form -->
<div class="form-container fade-in">
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Basic Info -->
        <h3 style="margin-bottom: 1.5rem; color: var(--dark); font-size: 1.2rem;">
            <i class="fas fa-info-circle"></i>
            Temel Bilgiler
        </h3>

        <div class="form-row">
            <div class="form-group">
                <label for="name">Proje Adı <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="form-control @error('name') error @enderror"
                       value="{{ old('name') }}" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug">Slug (Otomatik oluşturulur)</label>
                <input type="text" id="slug" name="slug" class="form-control @error('slug') error @enderror"
                       value="{{ old('slug') }}">
                @error('slug')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="category">Kategori <span class="required">*</span></label>
                <select id="category" name="category" class="form-control @error('category') error @enderror" required>
                    <option value="">Kategori Seçin</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="description">Kısa Açıklama <span class="required">*</span></label>
            <textarea id="description" name="description" class="form-control @error('description') error @enderror" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="long_description">Detaylı Açıklama</label>
            <textarea id="long_description" name="long_description" class="form-control" style="min-height: 200px;">{{ old('long_description') }}</textarea>
        </div>

        <!-- Project Details -->
        <h3 style="margin: 2rem 0 1.5rem; color: var(--dark); font-size: 1.2rem;">
            <i class="fas fa-cogs"></i>
            Proje Detayları
        </h3>

        <div class="form-row">
            <div class="form-group">
                <label for="duration">Proje Süresi <span class="required">*</span></label>
                <input type="text" id="duration" name="duration" class="form-control @error('duration') error @enderror"
                       value="{{ old('duration') }}" placeholder="Örn: 6 Ay" required>
                @error('duration')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="team_size">Ekip Büyüklüğü <span class="required">*</span></label>
                <input type="number" id="team_size" name="team_size" class="form-control @error('team_size') error @enderror"
                       value="{{ old('team_size', 1) }}" min="1" max="100" required>
                @error('team_size')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="year">Yıl <span class="required">*</span></label>
                <input type="number" id="year" name="year" class="form-control @error('year') error @enderror"
                       value="{{ old('year', date('Y')) }}" min="2020" max="2030" required>
                @error('year')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Durum <span class="required">*</span></label>
                <select id="status" name="status" class="form-control @error('status') error @enderror" required>
                    @foreach($statuses as $key => $label)
                        <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('status')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Links -->
        <h3 style="margin: 2rem 0 1.5rem; color: var(--dark); font-size: 1.2rem;">
            <i class="fas fa-link"></i>
            Bağlantılar
        </h3>

        <div class="form-row">
            <div class="form-group">
                <label for="url">Proje URL</label>
                <input type="url" id="url" name="url" class="form-control @error('url') error @enderror"
                       value="{{ old('url') }}" placeholder="https://example.com">
                @error('url')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Image -->
        <h3 style="margin: 2rem 0 1.5rem; color: var(--dark); font-size: 1.2rem;">
            <i class="fas fa-image"></i>
            Görsel
        </h3>

        <div class="form-group">
            <label class="image-upload" for="image">
                <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; color: var(--primary);"></i>
                <p style="margin: 1rem 0 0; color: var(--gray);">Resim yüklemek için tıklayın</p>
                <small style="color: var(--gray-light);">JPG, PNG veya WEBP (Max: 2MB)</small>
                <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
            </label>
            <img id="imagePreview" class="image-preview" alt="Preview">
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Featured -->
        <div class="form-group">
            <div class="checkbox-item">
                <input type="checkbox" id="featured" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                <label for="featured">Öne Çıkan Proje</label>
            </div>
        </div>

        <!-- Actions -->
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Projeyi Kaydet
            </button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline">
                <i class="fas fa-times"></i>
                İptal
            </a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Image Preview
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        const slug = document.getElementById('slug');
        if (!slug.value || slug.value === '') {
            slug.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-|-$/g, '');
        }
    });
</script>
@endsection
