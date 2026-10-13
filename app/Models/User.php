<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_SUPER_ADMIN = 'super_admin';
    public const ROLE_EDITOR = 'editor';
    public const ROLE_HR = 'hr';
    public const ROLE_CS = 'cs';

    public const ROLES = [
        self::ROLE_SUPER_ADMIN => 'Super Administrator',
        self::ROLE_EDITOR => 'Content Editor (Layanan & Portofolio)',
        self::ROLE_HR => 'HR & Rekrutmen (Karir & Loker)',
        self::ROLE_CS => 'Customer Service (Pesan Masuk)',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
        ];
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function canManageUsers(): bool
    {
        return $this->isSuperAdmin();
    }

    public function canManageSettings(): bool
    {
        return $this->isSuperAdmin();
    }

    public function canManageContent(): bool
    {
        return $this->isSuperAdmin() || ($this->role === self::ROLE_EDITOR);
    }

    public function canManageCareers(): bool
    {
        return $this->isSuperAdmin() || ($this->role === self::ROLE_HR);
    }

    public function canManageInquiries(): bool
    {
        return $this->isSuperAdmin() || ($this->role === self::ROLE_CS);
    }

    public function getRoleLabelAttribute(): string
    {
        return self::ROLES[$this->role] ?? 'Administrator';
    }

    public function getRoleShortLabelAttribute(): string
    {
        return match ($this->role) {
            self::ROLE_SUPER_ADMIN => 'Super Admin',
            self::ROLE_EDITOR => 'Editor',
            self::ROLE_HR => 'HR',
            self::ROLE_CS => 'CS',
            default => 'Admin',
        };
    }

    public function getRoleBadgeClassesAttribute(): string
    {
        return match ($this->role) {
            self::ROLE_SUPER_ADMIN => 'bg-[#6B2203]/10 text-[#6B2203] border-[#6B2203]/30',
            self::ROLE_EDITOR => 'bg-blue-50 text-blue-800 border-blue-200',
            self::ROLE_HR => 'bg-emerald-50 text-emerald-800 border-emerald-200',
            self::ROLE_CS => 'bg-amber-50 text-amber-800 border-amber-200',
            default => 'bg-[#965E03]/10 text-[#965E03] border-[#965E03]/20',
        };
    }
}
