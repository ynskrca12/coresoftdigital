<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Blog listesi
     */
    public function index(Request $request)
    {
        $query = Blog::query();

        // Arama
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Kategori filtresi
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Durum filtresi
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Featured filtresi
        if ($request->has('featured')) {
            $query->where('featured', true);
        }

        // Active filtresi
        if ($request->has('active')) {
            $query->where('active', $request->active === 'active');
        }

        // Sıralama
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $blogs = $query->paginate(15);

        // Filtreler için kategoriler
        $categories = Blog::distinct()->pluck('category')->filter()->sort()->values();

        // İstatistikler
        $stats = [
            'total' => Blog::count(),
            'published' => Blog::where('status', 'published')->count(),
            'draft' => Blog::where('status', 'draft')->count(),
            'scheduled' => Blog::where('status', 'scheduled')->count(),
        ];

        return view('admin.blog.blog_index', compact('blogs', 'categories', 'stats'));
    }

    /**
     * Blog oluşturma formu
     */
    public function create()
    {
        $categories = $this->getCategories();
        $tags = $this->getTags();

        return view('admin.blog.blog_create', compact('categories', 'tags'));
    }

    /**
     * Blog kaydetme
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:blogs,slug',
            'category' => 'required|string|max:100',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'author' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'order' => 'nullable|integer',
        ], [
            'title.required' => 'Blog başlığı gereklidir.',
            'category.required' => 'Kategori seçimi zorunludur.',
            'content.required' => 'Blog içeriği gereklidir.',
            'status.required' => 'Durum seçimi zorunludur.',
        ]);

        // Slug oluştur
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Author
        if (empty($validated['author'])) {
            $validated['author'] = auth()->user()->name ?? 'CoreSoft Digital';
        }

        // Published date
        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($validated['title']) . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/blog');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);
            $validated['image'] = 'images/blog/' . $imageName;
        }

        // Booleans
        $validated['featured'] = $request->has('featured');
        $validated['active'] = $request->has('active') ? true : false;

        // Create blog
        $blog = Blog::create($validated);

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog yazısı başarıyla oluşturuldu!');
    }

    /**
     * Blog detay
     */
    public function show(Blog $blog)
    {
        return view('admin.blog.blog_show', compact('blog'));
    }

    /**
     * Blog düzenleme formu
     */
    public function edit(Blog $blog)
    {
        $categories = $this->getCategories();
        $tags = $this->getTags();

        return view('admin.blog.blog_edit', compact('blog', 'categories', 'tags'));
    }

    /**
     * Blog güncelleme
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:blogs,slug,' . $blog->id,
            'category' => 'required|string|max:100',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'author' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        // Booleans
        $validated['featured'] = $request->has('featured');
        $validated['active'] = $request->has('active');

        // Image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($blog->image && file_exists(public_path($blog->image))) {
                unlink(public_path($blog->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($validated['title']) . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/blog');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);
            $validated['image'] = 'images/blog/' . $imageName;
        }

        // Published date
        if ($validated['status'] === 'published' && !$blog->published_at && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Update blog
        $blog->update($validated);

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog yazısı başarıyla güncellendi!');
    }

    /**
     * Blog silme
     */
    public function destroy(Blog $blog)
    {
        // Delete image
        if ($blog->image && file_exists(public_path($blog->image))) {
            unlink(public_path($blog->image));
        }

        $blog->delete();

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog yazısı başarıyla silindi!');
    }

    /**
     * Toggle status (Active/Inactive)
     */
    public function toggleStatus(Blog $blog)
    {
        $blog->update([
            'active' => !$blog->active
        ]);

        return response()->json([
            'success' => true,
            'active' => $blog->active,
            'message' => $blog->active ? 'Blog aktif edildi.' : 'Blog pasif edildi.'
        ]);
    }

    /**
     * Publish blog
     */
    public function publish(Blog $blog)
    {
        $blog->publish();

        return response()->json([
            'success' => true,
            'message' => 'Blog yayınlandı!'
        ]);
    }

    /**
     * Bulk delete
     */
    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|integer|exists:blogs,id',
        ]);

        $blogs = Blog::whereIn('id', $validated['ids'])->get();

        foreach ($blogs as $blog) {
            if ($blog->image && file_exists(public_path($blog->image))) {
                unlink(public_path($blog->image));
            }
            $blog->delete();
        }

        return response()->json([
            'success' => true,
            'message' => count($validated['ids']) . ' blog yazısı silindi.'
        ]);
    }

    /**
     * Quick add blog (for dashboard)
     */
    public function quickAdd(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['author'] = auth()->user()->name ?? 'CoreSoft Digital';
        $validated['status'] = 'draft';
        $validated['active'] = true;

        $blog = Blog::create($validated);

        return response()->json([
            'success' => true,
            'blog' => $blog,
            'message' => 'Blog taslağı oluşturuldu!',
            'redirect' => route('admin.blog.edit', $blog)
        ]);
    }

    /**
     * Helper: Get categories
     */
    private function getCategories()
    {
        return [
            'Yazılım Geliştirme',
            'Web Tasarım',
            'Mobil Uygulama',
            'E-Ticaret',
            'SEO & Dijital Pazarlama',
            'Teknoloji Haberleri',
            'Vaka Çalışmaları',
            'Yazılım Mimarisi',
            'Veritabanı',
            'Cloud & DevOps',
            'UI/UX Tasarım',
            'Siber Güvenlik',
            'Yapay Zeka',
            'Diğer',
        ];
    }

    /**
     * Helper: Get popular tags
     */
    private function getTags()
    {
        return [
            'Laravel',
            'React',
            'Vue.js',
            'PHP',
            'JavaScript',
            'Node.js',
            'Python',
            'Mobile',
            'Flutter',
            'React Native',
            'UI/UX',
            'Design',
            'SEO',
            'Marketing',
            'E-commerce',
            'API',
            'Database',
            'Cloud',
            'DevOps',
            'Security',
            'AI',
            'Machine Learning',
        ];
    }
}
