<?php
// app/Http/Controllers/Student/DashboardController.php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrolment;

class DashboardController extends Controller
{
    public function index()
    {
        $enrolments = Enrolment::where('student_id', auth()->id())
            ->with('course.instructor')
            ->latest()
            ->get();

        $stats = [
            'enrolled'  => $enrolments->whereIn('status', ['pending', 'active'])->count(),
            'active'    => $enrolments->where('status', 'active')->count(),
            'completed' => $enrolments->where('status', 'completed')->count(),
            'dropped'   => $enrolments->where('status', 'dropped')->count(),
        ];

        return view('student.dashboard', compact('stats', 'enrolments'));
    }
}