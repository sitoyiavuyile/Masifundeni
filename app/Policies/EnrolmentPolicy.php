<?php

namespace App\Policies;

use App\Models\Enrolment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EnrolmentPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null;
    }

    public function update(User $user, Enrolment $enrolment): bool
    {
        // Instructor owns the course this enrolment belongs to
        return $user->isInstructor()
            && $enrolment->course->instructor_id === $user->id;
    }

    public function delete(User $user, Enrolment $enrolment): bool
    {
        // Student drops their own enrolment
        if ($user->isStudent()) {
            return $enrolment->student_id === $user->id;
        }

        // Instructor removes from their own course
        return $user->isInstructor()
            && $enrolment->course->instructor_id === $user->id;
    }
}