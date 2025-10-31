<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Blog ana sayfası - Tüm blog yazıları
     */
    public function index(Request $request)
    {
        $query = Blog::active()->published();

        // Arama
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Kategori filtresi
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Tag filtresi
        if ($request->has('tag') && $request->tag != '') {
            $query->whereJsonContains('tags', $request->tag);
        }

        // Sıralama
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            case 'latest':
            default:
                $query->orderBy('published_at', 'desc');
                break;
        }

        // Pagination
        $blogs = $query->paginate(12)->withQueryString();

        // Sidebar data
        $categories = Blog::getCategories();
        $tags = Blog::getTags();
        $popularBlogs = Blog::getPopular(5);

        return view('blogs.blog_index', compact(
            'blogs',
            'categories',
            'tags',
            'popularBlogs'
        ));
    }

    /**
     * Blog detay sayfası
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->active()
            ->published()
            ->firstOrFail();

        // View sayısını artır
        $blog->incrementViews();

        // İlgili blog yazıları (aynı kategori)
        $relatedBlogs = Blog::active()
            ->published()
            ->where('category', $blog->category)
            ->where('id', '!=', $blog->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Son yazılar
        $recentBlogs = Blog::active()
            ->published()
            ->where('id', '!=', $blog->id)
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();

        // Tüm tags
        $tags = Blog::getTags();

        return view('blogs.blog_show', compact(
            'blog',
            'relatedBlogs',
            'recentBlogs',
            'tags'
        ));
    }

    /**
     * Kategori sayfası
     */
    public function category($slug)
    {
        $category = $slug;

        $blogs = Blog::active()
            ->published()
            ->where('category', $category)
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        // Sidebar data
        $categories = Blog::getCategories();
        $tags = Blog::getTags();
        $popularBlogs = Blog::getPopular(5);
        $recentBlogs = Blog::getRecent(5);

        return view('blog.category', compact(
            'blogs',
            'category',
            'categories',
            'tags',
            'popularBlogs',
            'recentBlogs'
        ));
    }

    /**
     * Etiket sayfası
     */
    public function tag($slug)
    {
        $tag = $slug;

        $blogs = Blog::active()
            ->published()
            ->whereJsonContains('tags', $tag)
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        // Sidebar data
        $categories = Blog::getCategories();
        $tags = Blog::getTags();
        $popularBlogs = Blog::getPopular(5);
        $recentBlogs = Blog::getRecent(5);

        return view('blog.tag', compact(
            'blogs',
            'tag',
            'categories',
            'tags',
            'popularBlogs',
            'recentBlogs'
        ));
    }
}
