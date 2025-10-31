<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'status',
        'phone',
        'avatar',
        'bio',
        'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'status' => 'boolean',
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->is_admin === 1 || $this->is_admin === true;
    }

    /**
     * Check if user is active
     */
    public function isActive(): bool
    {
        return $this->status === 1 || $this->status === true;
    }

    /**
     * Get user's full name
     */
    public function getFullNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * Get user's avatar URL
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }

        // Default avatar with initials
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=2563eb&background=e0e7ff';
    }

    /**
     * Get user's role label
     */
    public function getRoleLabelAttribute(): string
    {
        return $this->is_admin ? 'Admin' : 'Kullanıcı';
    }

    /**
     * Get user's status label
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status ? 'Aktif' : 'Pasif';
    }

    /**
     * Get user's status badge class
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return $this->status ? 'badge-success' : 'badge-danger';
    }

    /**
     * Scope: Only admins
     */
    public function scopeAdmins($query)
    {
        return $query->where('is_admin', 1);
    }

    /**
     * Scope: Only active users
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope: Only inactive users
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }
}
