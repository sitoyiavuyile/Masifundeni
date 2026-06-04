<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    // Admins bypass every policy method automatically
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null; // null = fall through to the specific method
    }

    public function viewAny(User $user): bool
    {
        return $user->isInstructor() || $user->isAdmin();
    }

    public function view(User $user, Course $course): bool
    {
        return $user->id === $course->instructor_id;
    }

    public function create(User $user): bool
    {
        return $user->isInstructor();
    }

    public function update(User $user, Course $course): bool
    {
        return $user->id === $course->instructor_id;
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->id === $course->instructor_id;
    }
}