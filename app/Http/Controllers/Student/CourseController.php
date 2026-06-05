<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::published()
            ->with('instructor')
            ->withCount('enrolments')
            ->paginate(12);

        // Tag which ones the student is already enrolled in
        $enrolledIds = auth()->user()
            ->enrolments()
            ->pluck('course_id')
            ->toArray();

        return view('student.courses.index', compact('courses', 'enrolledIds'));
    }

    public function enrol(Request $request, Course $course)
    {
        // Block enrolling in non-published courses
        abort_if($course->status !== 'published', 403);

        // Prevent duplicate enrolment
        $exists = Enrolment::where('student_id', auth()->id())
            ->where('course_id', $course->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You are already enrolled in this course.');
        }

        Enrolment::create([
            'student_id'  => auth()->id(),
            'course_id'   => $course->id,
            'status'      => 'pending',
            'enrolled_at' => now(),
        ]);

        return back()->with('success', 'Enrolment request submitted.');
    }
}
