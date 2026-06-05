<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\StoreCourseRequest;
use App\Http\Requests\Instructor\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CourseController extends Controller
{
    /** GET /instructor/courses */
    public function index(): View
    {
        $courses = Course::forInstructor(auth()->id())
            ->latest()
            ->paginate(10);

        return view('instructor.courses.index', compact('courses'));
    }

    /** GET /instructor/courses/create */
    public function create(): View
    {
        return view('instructor.courses.create');
    }

    /** POST /instructor/courses */
    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $course = Course::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('instructor.courses.show', $course)
            ->with('success', 'Course created successfully.');
    }

    /** GET /instructor/courses/{course} */
    public function show(Course $course): View
    {
        $this->authorize('view', $course);

        $course->load(['enrolments.student']);

        return view('instructor.courses.show', compact('course'));
    }

    /** GET /instructor/courses/{course}/edit */
    public function edit(Course $course): View
    {
        $this->authorize('update', $course);

        return view('instructor.courses.edit', compact('course'));
    }

    /** PUT /instructor/courses/{course} */
    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        $this->authorize('update', $course);

        $course->update($request->validated());

        return redirect()
            ->route('instructor.courses.show', $course)
            ->with('success', 'Course updated successfully.');
    }

    /** DELETE /instructor/courses/{course} */
    public function destroy(Course $course): RedirectResponse
    {
        $this->authorize('delete', $course);

        $course->delete();

        return redirect()
            ->route('instructor.courses.index')
            ->with('success', 'Course deleted.');
    }
}
