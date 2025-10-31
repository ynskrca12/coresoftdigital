@extends('admin.layouts.master')

@section('title', 'Blog Düzenle')

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

    /* Layout */
    .row {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .col-md-8 {
        flex: 1;
        min-width: 0;
    }

    .col-md-4 {
        width: 350px;
    }

    /* Content Box */
    .content-box {
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
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .box-title i {
        color: #3b82f6;
        font-size: 1.1rem;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0.5rem;
    }

    .text-danger {
        color: #ef4444;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.2s;
        background: white;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-control.is-invalid {
        border-color: #ef4444;
    }

    .invalid-feedback {
        display: block;
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 0.35rem;
    }

    .form-text {
        display: block;
        color: #94a3b8;
        font-size: 0.85rem;
        margin-top: 0.35rem;
    }

    textarea.form-control {
        resize: vertical;
        font-family: inherit;
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        padding-right: 2.5rem;
    }

    select[multiple].form-control {
        background-image: none;
        padding-right: 0.75rem;
        min-height: 120px;
    }

    /* Checkbox */
    .custom-control {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0;
    }

    .custom-control-input {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #3b82f6;
    }

    .custom-control-label {
        cursor: pointer;
        font-weight: 500;
        color: #475569;
        user-select: none;
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

    .btn-info {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        color: white;
    }

    .btn-info:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);
    }

    .btn-block {
        width: 100%;
    }

    /* Current Image */
    .current-image {
        margin-bottom: 1rem;
    }

    .current-image img {
        width: 100%;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    /* Image Upload */
    .image-upload-wrapper {
        text-align: center;
    }

    .form-control-file {
        display: block;
        width: 100%;
        padding: 0.75rem;
        border: 2px dashed #e2e8f0;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        background: #f8fafc;
    }

    .form-control-file:hover {
        border-color: #3b82f6;
        background: #eff6ff;
    }

    .image-preview {
        margin-top: 1rem;
        min-height: 200px;
        background: #f8fafc;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    .image-preview:empty {
        display: none;
    }

    .image-preview img {
        max-width: 100%;
        max-height: 300px;
        object-fit: contain;
    }

    /* Stats */
    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
    }

    .stat-item:last-child {
        border-bottom: none;
    }

    .stat-item i {
        font-size: 1.1rem;
    }

    .stat-item strong {
        color: #1e293b;
    }

    .text-info {
        color: #0891b2;
    }

    .text-warning {
        color: #d97706;
    }

    .text-success {
        color: #059669;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .col-md-4 {
            width: 100%;
        }

        .row {
            flex-direction: column;
        }
    }

    @media (max-width: 768px) {
        .header-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .content-box {
            padding: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="content-header">
    <div class="header-top">
        <div class="header-left">
            <h1 class="content-title">
                <i class="fas fa-edit"></i>
                Blog Düzenle
            </h1>
            <p class="content-subtitle">{{ $blog->title }}</p>
        </div>
        <div class="header-right">
            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Geri Dön
            </a>
            <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-info" target="_blank">
                <i class="fas fa-eye"></i>
                Önizle
            </a>
        </div>
    </div>
</div>

<form action="{{ route('admin.blog.update', $blog) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- Main Content -->
        <div class="col-md-8">
            <div class="content-box">
                <h3 class="box-title">Blog Bilgileri</h3>

                <!-- Title -->
                <div class="form-group">
                    <label for="title">Başlık <span class="text-danger">*</span></label>
                    <input type="text"
                           name="title"
                           id="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $blog->title) }}"
                           required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slug -->
                <div class="form-group">
                    <label for="slug">Slug (URL)</label>
                    <input type="text"
                           name="slug"
                           id="slug"
                           class="form-control @error('slug') is-invalid @enderror"
                           value="{{ old('slug', $blog->slug) }}">
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Excerpt -->
                <div class="form-group">
                    <label for="excerpt">Özet</label>
                    <textarea name="excerpt"
                              id="excerpt"
                              rows="3"
                              class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt', $blog->excerpt) }}</textarea>
                    <small class="form-text">Kısa bir özet yazın (opsiyonel)</small>
                    @error('excerpt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Content -->
                <div class="form-group">
                    <label for="content">İçerik <span class="text-danger">*</span></label>
                    <textarea name="content"
                              id="content"
                              rows="15"
                              class="form-control @error('content') is-invalid @enderror"
                              required>{{ old('content', $blog->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="content-box">
                <h3 class="box-title">
                    <i class="fas fa-search"></i>
                    SEO Ayarları
                </h3>

                <div class="form-group">
                    <label for="meta_title">Meta Başlık</label>
                    <input type="text"
                           name="meta_title"
                           id="meta_title"
                           class="form-control"
                           value="{{ old('meta_title', $blog->meta_title) }}">
                </div>

                <div class="form-group">
                    <label for="meta_description">Meta Açıklama</label>
                    <textarea name="meta_description"
                              id="meta_description"
                              rows="3"
                              class="form-control">{{ old('meta_description', $blog->meta_description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="meta_keywords">Meta Anahtar Kelimeler</label>
                    <input type="text"
                           name="meta_keywords"
                           id="meta_keywords"
                           class="form-control"
                           value="{{ old('meta_keywords', $blog->meta_keywords) }}"
                           placeholder="kelime1, kelime2, kelime3">
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Publish -->
            <div class="content-box">
                <h3 class="box-title">Yayınla</h3>

                <div class="form-group">
                    <label for="status">Durum <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Taslak</option>
                        <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>Yayınla</option>
                        <option value="scheduled" {{ old('status', $blog->status) == 'scheduled' ? 'selected' : '' }}>Zamanla</option>
                    </select>
                </div>

                <div class="form-group" id="publishDateGroup" style="display: {{ old('status', $blog->status) == 'scheduled' ? 'block' : 'none' }};">
                    <label for="published_at">Yayın Tarihi</label>
                    <input type="datetime-local"
                           name="published_at"
                           id="published_at"
                           class="form-control"
                           value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '') }}">
                </div>

                <div class="form-group">
                    <div class="custom-control">
                        <input type="checkbox"
                               name="active"
                               id="active"
                               class="custom-control-input"
                               {{ old('active', $blog->active) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="active">
                            Aktif
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control">
                        <input type="checkbox"
                               name="featured"
                               id="featured"
                               class="custom-control-input"
                               {{ old('featured', $blog->featured) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="featured">
                            Öne Çıkan
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-save"></i>
                    Güncelle
                </button>
            </div>

            <!-- Image -->
            <div class="content-box">
                <h3 class="box-title">Görsel</h3>

                @if($blog->image)
                <div class="current-image">
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}">
                </div>
                @endif

                <div class="form-group">
                    <div class="image-upload-wrapper">
                        <input type="file"
                               name="image"
                               id="image"
                               class="form-control-file"
                               accept="image/*">
                        <div class="image-preview" id="imagePreview"></div>
                    </div>
                    <small class="form-text">Yeni görsel yüklemek için seçin</small>
                </div>
            </div>

            <!-- Category & Tags -->
            <div class="content-box">
                <h3 class="box-title">Kategori & Etiketler</h3>

                <div class="form-group">
                    <label for="category">Kategori <span class="text-danger">*</span></label>
                    <select name="category" id="category" class="form-control" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category', $blog->category) == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tags">Etiketler</label>
                    <select name="tags[]" id="tags" class="form-control" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag }}" {{ in_array($tag, old('tags', $blog->tags ?? [])) ? 'selected' : '' }}>
                                {{ $tag }}
                            </option>
                        @endforeach
                    </select>
                    <small class="form-text">Birden fazla etiket seçebilirsiniz (Ctrl/Cmd tuşu ile)</small>
                </div>
            </div>

            <!-- Statistics -->
            <div class="content-box">
                <h3 class="box-title">İstatistikler</h3>

                <div class="stat-item">
                    <i class="fas fa-eye text-info"></i>
                    <span><strong>{{ number_format($blog->views) }}</strong> görüntülenme</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-clock text-warning"></i>
                    <span><strong>{{ $blog->reading_time }}</strong> dk okuma süresi</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-calendar text-success"></i>
                    <span>{{ $blog->created_at->format('d.m.Y H:i') }}</span>
                </div>
            </div>

            <!-- Author & Order -->
            <div class="content-box">
                <h3 class="box-title">Diğer</h3>

                <div class="form-group">
                    <label for="author">Yazar</label>
                    <input type="text"
                           name="author"
                           id="author"
                           class="form-control"
                           value="{{ old('author', $blog->author) }}">
                </div>

                <div class="form-group">
                    <label for="order">Sıra</label>
                    <input type="number"
                           name="order"
                           id="order"
                           class="form-control"
                           value="{{ old('order', $blog->order) }}"
                           min="0">
                    <small class="form-text">Küçük sayılar önce görünür</small>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
// Show/hide publish date based on status
document.getElementById('status').addEventListener('change', function() {
    const publishDateGroup = document.getElementById('publishDateGroup');
    if (this.value === 'scheduled') {
        publishDateGroup.style.display = 'block';
    } else {
        publishDateGroup.style.display = 'none';
    }
});

// Image preview
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
