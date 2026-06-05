<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ──────────────────────────────────────────
    // Role helpers (Member 1)
    // ──────────────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isInstructor(): bool
    {
        return $this->role === 'instructor';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    // ──────────────────────────────────────────
    // Relationships — Member 1
    // ──────────────────────────────────────────

    public function studentProfile(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(StudentProfile::class);
    }

    // ──────────────────────────────────────────
    // Relationships — Member 2 additions
    // ──────────────────────────────────────────

    /** Courses this user teaches (instructor) */
    public function taughtCourses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Course::class, 'user_id');
    }

    /** Enrolment records for this student */
    public function enrolments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Enrolment::class, 'student_id');
    }

    /** Courses this student is enrolled in */
    public function enrolledCourses(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(
            Course::class,
            Enrolment::class,
            'user_id',    // FK on enrolments
            'id',         // FK on courses
            'id',         // local key on users
            'course_id'   // local key on enrolments
        );
    }
    // Add to app/Models/User.php

    public function courses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

}

