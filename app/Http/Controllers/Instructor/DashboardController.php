<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrolment;

class DashboardController extends Controller
{
    public function index()
{
    $courses = Course::forInstructor(auth()->id())
            ->withCount('enrolments')
            ->latest()
            ->get();

        $stats = [
            'total_courses'    => $courses->count(),
            'published'        => $courses->where('status', 'published')->count(),
            'total_students'   => Enrolment::whereIn('course_id', $courses->pluck('id'))
                                    ->distinct('student_id')
                                    ->count(),
            'pending_approvals' => Enrolment::whereIn('course_id', $courses->pluck('id'))
                                    ->where('status', 'pending')
                                    ->count(),
        ];

        $pendingEnrolments = Enrolment::whereIn('course_id', $courses->pluck('id'))
            ->where('status', 'pending')
            ->with('student', 'course')
            ->latest()
            ->take(5)
            ->get();

        return view('instructor.dashboard', compact('stats', 'courses', 'pendingEnrolments'));
}
}
