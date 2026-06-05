<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrolment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
{
    $stats = [
            'total_students'    => User::where('role', 'student')->count(),
            'total_instructors' => User::where('role', 'instructor')->count(),
            'total_courses'     => Course::count(),
            'total_enrolments'  => Enrolment::count(),
        ];

        $recentStudents = User::where('role', 'student')
            ->with('studentProfile')
            ->latest()
            ->take(5)
            ->get();

        $recentCourses = Course::with('instructor')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentStudents', 'recentCourses'));
}
}
