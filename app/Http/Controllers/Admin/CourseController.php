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
    public function index()
    {
        $courses = Course::with('instructor')->latest()->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $instructors = User::where('role', 'instructor')->get();
        return view('admin.courses.create', compact('instructors'));
    }

    public function store(StoreCourseRequest $request)
    {
        Course::create([
            'instructor_id' => $request->instructor_id,
            'title'         => $request->title,
            'description'   => $request->description,
            'status'        => $request->status,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Course created.');
    }

    public function edit(Course $course)
    {
        $instructors = User::where('role', 'instructor')->get();
        return view('admin.courses.edit', compact('course', 'instructors'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated() + ['instructor_id' => $request->instructor_id]);
        return redirect()->route('admin.courses.index')->with('success', 'Course updated.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted.');
    }

    public function show(Course $course)
    {
        $course->load('instructor', 'enrolments.student');
        return view('admin.courses.show', compact('course'));
    }
}
