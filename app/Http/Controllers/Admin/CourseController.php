<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCourseRequest;
use App\Http\Requests\Admin\UpdateCourseRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CourseController extends Controller
{
    /** GET /admin/courses */
    public function index(): View
    {
        $courses = Course::with('instructor')
            ->latest()
            ->paginate(15);

        return view('admin.courses.index', compact('courses'));
    }

    /** GET /admin/courses/create */
    public function create(): View
    {
        $instructors = User::where('role', 'instructor')->orderBy('name')->get();

        return view('admin.courses.create', compact('instructors'));
    }

    /** POST /admin/courses */
    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $course = Course::create($request->validated());

        return redirect()
            ->route('admin.courses.show', $course)
            ->with('success', 'Course created successfully.');
    }

    /** GET /admin/courses/{course} */
    public function show(Course $course): View
    {
        $course->load(['instructor', 'enrolments.student']);

        return view('admin.courses.show', compact('course'));
    }

    /** GET /admin/courses/{course}/edit */
    public function edit(Course $course): View
    {
        $instructors = User::where('role', 'instructor')->orderBy('name')->get();

        return view('admin.courses.edit', compact('course', 'instructors'));
    }

    /** PUT /admin/courses/{course} */
    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        $course->update($request->validated());

        return redirect()
            ->route('admin.courses.show', $course)
            ->with('success', 'Course updated.');
    }

    /** DELETE /admin/courses/{course} */
    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course deleted.');
    }
}
