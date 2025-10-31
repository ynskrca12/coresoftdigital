<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects.
     */
    public function index(Request $request)
    {
        $query = Project::query();

        // Search
        if ($search = $request->get('search')) {
            $query->search($search);
        }

        // Filter by category
        if ($category = $request->get('category')) {
            $query->byCategory($category);
        }

        // Filter by status
        if ($status = $request->get('status')) {
            $query->byStatus($status);
        }

        // Filter by year
        if ($year = $request->get('year')) {
            $query->byYear($year);
        }

        // Get projects with pagination
        $projects = $query->orderBy('order')->latest()->paginate(15);

        // Get filter options
        $categories = $this->getCategories();
        $statuses = $this->getStatuses();
        $years = $this->getYears();

        return view('admin.projects.project_index', compact('projects', 'categories', 'statuses', 'years'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        $categories = $this->getCategories();
        $statuses = $this->getStatuses();

        return view('admin.projects.project_create', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created project.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:projects,slug',
            'category' => 'required|string',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'duration' => 'required|string',
            'year' => 'required|integer|min:2020|max:2030',
            'status' => 'required|in:in_progress,completed,on_hold',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'url' => 'nullable|url',
            'order' => 'nullable|integer',
        ], [
            'name.required' => 'Proje adı gereklidir.',
            'category.required' => 'Kategori seçimi zorunludur.',
            'description.required' => 'Proje açıklaması gereklidir.',
            'duration.required' => 'Proje süresi gereklidir.',
            'year.required' => 'Proje yılı gereklidir.',
            'status.required' => 'Proje durumu seçimi zorunludur.',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle image upload to public/images/projects
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($validated['name']) . '.' . $image->getClientOriginalExtension();

            // Create directory if not exists
            $destinationPath = public_path('images/projects');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move image to public/images/projects
            $image->move($destinationPath, $imageName);
            $validated['image'] = 'images/projects/' . $imageName;
        }

        // Create project
        $project = Project::create($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Proje başarıyla oluşturuldu!');
    }


    /**
     * Display the specified project.
     */
    public function show(Project $project)
    {
        return view('admin.projects.project_show', compact('project'));
    }

    /**
     * Show the form for editing project.
     */
    public function edit(Project $project)
    {
        $categories = $this->getCategories();
        $statuses = $this->getStatuses();

        return view('admin.projects.project_edit', compact('project', 'categories', 'statuses'));
    }

    /**
     * Update the specified project.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:projects,slug,' . $project->id,
            'category' => 'required|string',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'duration' => 'required|string',
            'year' => 'required|integer|min:2020|max:2030',
            'status' => 'required|in:in_progress,completed,on_hold',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'url' => 'nullable|url',
            'order' => 'nullable|integer',
        ]);

        // Handle image upload to public/images/projects
        if ($request->hasFile('image')) {
            // Delete old image
            if ($project->image && file_exists(public_path($project->image))) {
                unlink(public_path($project->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($validated['name']) . '.' . $image->getClientOriginalExtension();

            // Create directory if not exists
            $destinationPath = public_path('images/projects');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move image to public/images/projects
            $image->move($destinationPath, $imageName);
            $validated['image'] = 'images/projects/' . $imageName;
        }

        // Update project
        $project->update($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Proje başarıyla güncellendi!');
    }

    /**
     * Remove the specified project.
     */
    public function destroy(Project $project)
    {
        // Delete image from public/images/projects
        if ($project->image && file_exists(public_path($project->image))) {
            unlink(public_path($project->image));
        }

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Proje başarıyla silindi!');
    }

    /**
     * Toggle project status.
     */
    public function toggleStatus(Project $project)
    {
        $project->update(['active' => !$project->active]);

        return response()->json([
            'success' => true,
            'active' => $project->active,
            'message' => $project->active ? 'Proje aktif edildi.' : 'Proje pasif edildi.'
        ]);
    }

    /**
     * Bulk delete projects.
     */
    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|integer|exists:projects,id',
        ]);

        $projects = Project::whereIn('id', $validated['ids'])->get();

        foreach ($projects as $project) {
            // Delete image from public/images/projects
            if ($project->image && file_exists(public_path($project->image))) {
                unlink(public_path($project->image));
            }
            $project->delete();
        }

        return response()->json([
            'success' => true,
            'message' => count($validated['ids']) . ' proje silindi.'
        ]);
    }

    // ========================================
    // HELPER METHODS
    // ========================================

    /**
     * Get categories
     */
    private function getCategories()
    {
        return [
            'E-Ticaret',
            'Kurumsal Yazılım',
            'Mobil Uygulama',
            'Web Uygulaması',
            'Eğitim Platformu',
            'Sağlık Yazılımı',
            'Fintech',
            'CRM',
            'ERP',
        ];
    }

    /**
     * Get statuses
     */
    private function getStatuses()
    {
        return [
            'in_progress' => 'Devam Ediyor',
            'completed' => 'Tamamlandı',
            'on_hold' => 'Beklemede',
        ];
    }

    /**
     * Get years
     */
    private function getYears()
    {
        return range(date('Y'), 2020);
    }
}
