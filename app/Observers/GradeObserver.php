<?php
// app/Observers/GradeObserver.php

namespace App\Observers;

use App\Actions\GenerateProgressReport;
use App\Models\Grade;

class GradeObserver
{
    public function saved(Grade $grade): void
    {
        app(GenerateProgressReport::class)->handle($grade->enrolment);
    }

    public function deleted(Grade $grade): void
    {
        app(GenerateProgressReport::class)->handle($grade->enrolment);
    }
}