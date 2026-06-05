<?php

namespace App\Observers;

use App\Models\Enrolment;
use Illuminate\Support\Facades\Log;

class EnrolmentObserver
{
    /**
     * Fired after a new enrolment is saved.
     * Future: send welcome email to student, notify instructor, etc.
     */
    public function created(Enrolment $enrolment): void
    {
        Log::info('Student enrolled', [
            'student_id' => $enrolment->user_id,
            'course_id'  => $enrolment->course_id,
        ]);
    }

    /**
     * Fired after an enrolment is updated.
     * Future: dispatch GradePosted event when grade changes.
     */
    public function updated(Enrolment $enrolment): void
    {
        if ($enrolment->wasChanged('grade') && $enrolment->grade !== null) {
            Log::info('Grade posted', [
                'enrolment_id' => $enrolment->id,
                'grade'        => $enrolment->grade,
                'letter'       => $enrolment->letter_grade,
            ]);
            // Future: event(new GradePosted($enrolment));
        }

        if ($enrolment->wasChanged('status')) {
            Log::info('Enrolment status changed', [
                'enrolment_id' => $enrolment->id,
                'from'         => $enrolment->getOriginal('status'),
                'to'           => $enrolment->status,
            ]);
        }
    }

    /**
     * Fired after an enrolment is deleted.
     */
    public function deleted(Enrolment $enrolment): void
    {
        Log::info('Student removed from course', [
            'student_id' => $enrolment->user_id,
            'course_id'  => $enrolment->course_id,
        ]);
    }
}
