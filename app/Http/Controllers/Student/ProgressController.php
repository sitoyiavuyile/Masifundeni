<?php
// app/Http/Controllers/Student/ProgressController.php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrolment;

class ProgressController extends Controller
{
    public function index()
    {
        $enrolments = Enrolment::where('student_id', auth()->id())
            ->with(['course', 'grades', 'course.instructor'])
            ->get();

        return view('student.progress.index', compact('enrolments'));
    }
}