<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /** Roles (admin is set by developer only, not in sign up) */
    public const ROLE_ADMIN = 'admin';
    public const ROLE_TEACHER = 'teacher';
    public const ROLE_STUDENT = 'student';

    public static function signupRoles(): array
    {
        return [
            self::ROLE_TEACHER => 'Teacher',
            self::ROLE_STUDENT => 'Student',
        ];
    }

    public static function allRoles(): array
    {
        return [
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_TEACHER => 'Teacher',
            self::ROLE_STUDENT => 'Student',
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'bio',
        'biography',
        'teaching_courses',
        'type',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'teaching_courses' => 'array',
    ];

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function academicPositions()
    {
        return $this->hasMany(AcademicPosition::class);
    }

    public function isAdmin(): bool
    {
        return $this->type !== null && strtolower((string) $this->type) === self::ROLE_ADMIN;
    }

    public function isTeacher(): bool
    {
        return $this->type === self::ROLE_TEACHER;
    }

    public function isStudent(): bool
    {
        return $this->type === self::ROLE_STUDENT;
    }

    public function canAccessAdminPanel(): bool
    {
        return $this->isAdmin() || $this->isTeacher();
    }
}
