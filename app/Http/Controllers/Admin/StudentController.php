<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStudentRequest;
use App\Http\Requests\Admin\UpdateStudentRequest;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $students = User::query()
            ->where('role', 'student')
            ->with('studentProfile')
            ->latest()
            ->paginate(15);

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(StoreStudentRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'student',
            ]);

            $user->assignRole('student');

            StudentProfile::create([
                'user_id'        => $user->id,
                'student_number' => 'STU-' . str_pad($user->id, 5, '0', STR_PAD_LEFT),
                'phone'          => $request->phone,
                'date_of_birth'  => $request->date_of_birth,
                'address'        => $request->address,
                'status'         => $request->status,
            ]);
        });

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student created successfully.');
    }

    public function show(User $student)
    {
        $this->authorize('view', $student);

        $student->load('studentProfile', 'enrolments.course');

        return view('admin.students.show', compact('student'));
    }

    public function edit(User $student)
    {
        $this->authorize('update', $student);

        $student->load('studentProfile');

        return view('admin.students.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, User $student)
    {
        DB::transaction(function () use ($request, $student) {
            $student->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $student->update(['password' => Hash::make($request->password)]);
            }

            $student->studentProfile->update([
                'phone'          => $request->phone,
                'date_of_birth'  => $request->date_of_birth,
                'address'        => $request->address,
                'status'         => $request->status,
            ]);
        });

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(User $student)
    {
        $this->authorize('delete', $student);

        // cascadeOnDelete on the FK handles the profile
        $student->delete();

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student deleted.');
    }
}