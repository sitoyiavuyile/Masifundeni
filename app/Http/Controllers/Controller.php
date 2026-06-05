<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrolment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * GET /student/courses
     * Browse all published courses; show enrolment status for current student.
     */
    public function index(): View
    {
        $student = auth()->user();

        $enrolledCourseIds = Enrolment::forStudent($student->id)
            ->pluck('course_id');

        $courses = Course::published()
            ->with('instructor')
            ->latest()
            ->paginate(12);

        return view('student.courses.index', compact('courses', 'enrolledCourseIds'));
    }

    /**
     * POST /student/courses/{course}/enrol
     * Enrol the current student in a course.
     */
    public function enrol(Course $course): RedirectResponse
    {
        $student = auth()->user();

        // Prevent duplicate enrolment
        $alreadyEnrolled = Enrolment::where('user_id', $student->id)
            ->where('course_id', $course->id)
            ->exists();

        if ($alreadyEnrolled) {
            return back()->with('error', 'You are already enrolled in this course.');
        }

        if ($course->status !== 'published') {
            return back()->with('error', 'This course is not available for enrolment.');
        }

        Enrolment::create([
            'user_id'   => $student->id,
            'course_id' => $course->id,
            'status'    => 'active',
        ]);

        return redirect()
            ->route('student.courses.index')
            ->with('success', 'Successfully enrolled in ' . $course->title);
    }
}
