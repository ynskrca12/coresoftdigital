<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'tags',
        'excerpt',
        'content',
        'image',
        'author',
        'status',
        'published_at',
        'views',
        'reading_time',
        'featured',
        'active',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'order',
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
        'featured' => 'boolean',
        'active' => 'boolean',
        'views' => 'integer',
        'reading_time' => 'integer',
    ];

    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }

            if (empty($blog->reading_time)) {
                $blog->reading_time = static::calculateReadingTime($blog->content);
            }
        });

        static::updating(function ($blog) {
            if ($blog->isDirty('content')) {
                $blog->reading_time = static::calculateReadingTime($blog->content);
            }
        });
    }

    /**
     * Calculate reading time
     */
    public static function calculateReadingTime($content)
    {
        $wordCount = str_word_count(strip_tags($content));
        $minutes = ceil($wordCount / 200); // 200 words per minute
        return max(1, $minutes);
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeTag($query, $tag)
    {
        return $query->whereJsonContains('tags', $tag);
    }

    /**
     * Accessors
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset($this->image);
        }
        return asset('images/blog-default.jpg');
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'draft' => 'Taslak',
            'published' => 'Yayında',
            'scheduled' => 'Zamanlanmış',
            default => 'Bilinmiyor',
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            'draft' => 'badge-secondary',
            'published' => 'badge-success',
            'scheduled' => 'badge-warning',
            default => 'badge-secondary',
        };
    }

    public function getExcerptOrContentAttribute(): string
    {
        return $this->excerpt ?: Str::limit(strip_tags($this->content), 200);
    }

    public function getFormattedPublishedDateAttribute(): string
    {
        if (!$this->published_at) {
            return '-';
        }
        return $this->published_at->format('d.m.Y');
    }

    public function getFormattedPublishedDateTimeAttribute(): string
    {
        if (!$this->published_at) {
            return '-';
        }
        return $this->published_at->format('d.m.Y H:i');
    }

    public function getReadingTimeTextAttribute(): string
    {
        return $this->reading_time . ' dk okuma';
    }

    public function getIsPublishedAttribute(): bool
    {
        return $this->status === 'published' &&
               $this->published_at &&
               $this->published_at->isPast();
    }

    /**
     * Helpers
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    public function publish()
    {
        $this->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
    }

    public function unpublish()
    {
        $this->update([
            'status' => 'draft',
        ]);
    }

    /**
     * Static helpers
     */
    public static function getCategories()
    {
        return self::active()
            ->published()
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort()
            ->values();
    }

    public static function getTags()
    {
        $blogs = self::active()
            ->published()
            ->whereNotNull('tags')
            ->get();

        $tags = [];
        foreach ($blogs as $blog) {
            if ($blog->tags) {
                $tags = array_merge($tags, $blog->tags);
            }
        }

        return collect($tags)->unique()->sort()->values();
    }

    public static function getPopular($limit = 5)
    {
        return self::active()
            ->published()
            ->orderBy('views', 'desc')
            ->limit($limit)
            ->get();
    }

    public static function getRecent($limit = 5)
    {
        return self::active()
            ->published()
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
