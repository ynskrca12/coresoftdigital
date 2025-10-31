<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Projeler sayfası - Tüm projeler
     */
    public function index(Request $request)
    {
        $query = Project::active();

        // Kategori filtresi
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Yıl filtresi
        if ($request->has('year') && $request->year != '') {
            $query->where('year', $request->year);
        }

        // Durum filtresi
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Arama
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('long_description', 'like', "%{$search}%");
            });
        }

        // Sıralama
        $query->orderBy('order', 'asc')
              ->orderBy('created_at', 'desc');

        // Projeler
        $projects = $query->paginate(12);

        // Filtre için kategoriler
        $categories = Project::active()
            ->distinct()
            ->pluck('category')
            ->sort()
            ->values();

        // Filtre için yıllar
        $years = Project::active()
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('projects.projects_index', compact('projects', 'categories', 'years'));
    }

    /**
     * Proje detay sayfası
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();

        // Benzer projeler (aynı kategori, 3 tane)
        $relatedProjects = Project::active()
            ->where('category', $project->category)
            ->where('id', '!=', $project->id)
            ->orderBy('order', 'asc')
            ->limit(3)
            ->get();

        return view('projects.project_show', compact('project', 'relatedProjects'));
    }
}
