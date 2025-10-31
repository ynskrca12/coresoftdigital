<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'long_description',
        'duration',
        'year',
        'status',
        'image',
        'gallery',
        'url',
        'order',
        'active',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'gallery' => 'array',
        'active' => 'boolean',
        'year' => 'integer',
        'order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug from name
        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->name);
            }
        });

        // Update slug if name changes
        static::updating(function ($project) {
            if ($project->isDirty('name') && empty($project->slug)) {
                $project->slug = Str::slug($project->name);
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Scope: Active projects
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope: By category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope: By status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope: By year
     */
    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    /**
     * Scope: Search
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('category', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'in_progress' => 'Devam Ediyor',
            'completed' => 'Tamamlandı',
            'on_hold' => 'Beklemede',
            default => 'Bilinmiyor',
        };
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            'in_progress' => 'badge-warning',
            'completed' => 'badge-success',
            'on_hold' => 'badge-secondary',
            default => 'badge-secondary',
        };
    }

    /**
     * Get image URL
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset($this->image);
        }
        return asset('images/default-project.jpg');
    }

    /**
     * Get gallery URLs
     */
    public function getGalleryUrlsAttribute(): array
    {
        if (!$this->gallery) {
            return [];
        }

        return array_map(function($image) {
            return asset('storage/' . $image);
        }, $this->gallery);
    }
}
