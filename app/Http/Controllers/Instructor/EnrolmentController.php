<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\UpdateEnrolmentRequest;
use App\Models\Course;
use App\Models\Enrolment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EnrolmentController extends Controller
{
    // List enrolments for a course
    public function index(Course $course)
    {
        $this->authorize('view', $course);

        $enrolments = $course->enrolments()
            ->with('student')
            ->latest()
            ->paginate(20);

        return view('instructor.enrolments.index', compact('course', 'enrolments'));
    }

    // Update enrolment status (approve, complete, drop)
    public function update(UpdateEnrolmentRequest $request, Enrolment $enrolment)
    {
        // $this->authorize() call can now be removed — authorize() in the request handles it
        $enrolment->update(['status' => $request->status]);

        return back()->with('success', 'Enrolment updated.');
    }

    // Instructor removes a student from a course
    public function destroy(Enrolment $enrolment)
    {
        $this->authorize('delete', $enrolment);

        $enrolment->delete();

        return back()->with('success', 'Student removed from course.');
    }
}
