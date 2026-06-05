<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'code',
        'description',
        'status',
        'credits',
    ];

    protected function casts(): array
    {
        return [
            'credits' => 'integer',
        ];
    }

    // ──────────────────────────────────────────
    // Relationships
    // ──────────────────────────────────────────

    /** The instructor who owns this course */
    public function instructor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** All enrolment records for this course */
    public function enrolments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Enrolment::class);
    }

    /** Students enrolled in this course (through enrolments) */
    public function students(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(
            User::class,
            Enrolment::class,
            'course_id',   // FK on enrolments
            'id',          // FK on users
            'id',          // local key on courses
            'user_id'      // local key on enrolments
        );
    }

    // ──────────────────────────────────────────
    // Scopes
    // ──────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }

    public function scopeArchived(Builder $query): Builder
    {
        return $query->where('status', 'archived');
    }

    public function scopeForInstructor(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    /** Search by title or code */
    public function scopeSearch(Builder $query, string $term): Builder
    {
        return $query->where(function (Builder $q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
              ->orWhere('code', 'like', "%{$term}%");
        });
    }

    // ──────────────────────────────────────────
    // Accessors / Mutators
    // ──────────────────────────────────────────

    /** Display-friendly status label */
    protected function statusLabel(): Attribute
    {
        return Attribute::get(fn () => ucfirst($this->status));
    }

    /** Uppercase the course code before saving */
    protected function code(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => strtoupper($value),
        );
    }

    /** Short description — first 120 chars */
    protected function shortDescription(): Attribute
    {
        return Attribute::get(
            fn () => $this->description
                ? Str::limit($this->description, 120)
                : '—'
        );
    }

    // ──────────────────────────────────────────
    // Observer hooks (boot)
    // ──────────────────────────────────────────

    protected static function boot(): void
    {
        parent::boot();

        // When a course is deleted, its enrolments cascade via the DB constraint.
        // Log or fire events here if needed in the future.
        static::deleting(function (Course $course) {
            // Future: dispatch CourseDeleted event for notifications
        });
    }
}
