<?php

namespace App\Observers;

use App\Models\Enrolment;
use Illuminate\Support\Facades\Log;

class EnrolmentObserver
{
   public function updating(Enrolment $enrolment): void
    {
        // Auto-set completed_at when status changes to completed
        if ($enrolment->isDirty('status') && $enrolment->status === 'completed') {
            $enrolment->completed_at = now();
        }

        // Clear completed_at if status is moved back
        if ($enrolment->isDirty('status') && $enrolment->status !== 'completed') {
            $enrolment->completed_at = null;
        }
    } 
}
