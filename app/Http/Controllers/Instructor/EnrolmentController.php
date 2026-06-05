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
    /**
     * GET /instructor/courses/{course}/enrolments
     * List all students enrolled in a course.
     */
    public function index(Course $course): View
    {
        $this->authorize('viewAny', [Enrolment::class, $course]);

        $enrolments = $course->enrolments()
            ->with('student')
            ->latest()
            ->paginate(20);

        return view('instructor.enrolments.index', compact('course', 'enrolments'));
    }

    /**
     * GET /instructor/enrolments/{enrolment}
     * Show a single enrolment record (shallow).
     */
    public function show(Enrolment $enrolment): View
    {
        $this->authorize('view', $enrolment);

        $enrolment->load(['student', 'course']);

        return view('instructor.enrolments.show', compact('enrolment'));
    }

    /**
     * GET /instructor/enrolments/{enrolment}/edit
     * Form to update grade / status.
     */
    public function edit(Enrolment $enrolment): View
    {
        $this->authorize('update', $enrolment);

        $enrolment->load(['student', 'course']);

        return view('instructor.enrolments.edit', compact('enrolment'));
    }

    /**
     * PUT /instructor/enrolments/{enrolment}
     * Update grade and/or status.
     */
    public function update(UpdateEnrolmentRequest $request, Enrolment $enrolment): RedirectResponse
    {
        $this->authorize('update', $enrolment);

        $enrolment->update($request->validated());

        return redirect()
            ->route('instructor.courses.enrolments.index', $enrolment->course_id)
            ->with('success', 'Enrolment updated.');
    }

    /**
     * DELETE /instructor/enrolments/{enrolment}
     * Remove a student from the course.
     */
    public function destroy(Enrolment $enrolment): RedirectResponse
    {
        $this->authorize('delete', $enrolment);

        $courseId = $enrolment->course_id;
        $enrolment->delete();

        return redirect()
            ->route('instructor.courses.enrolments.index', $courseId)
            ->with('success', 'Student removed from course.');
    }
}
