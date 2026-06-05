<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Instructor;
use App\Http\Controllers\Student;

require __DIR__.'/auth.php';

// Root redirect — sends each role to their dashboard
Route::middleware('auth')->get('/', function () {
    return match(true) {
        auth()->user()->isAdmin()      => redirect()->route('admin.dashboard'),
        auth()->user()->isInstructor() => redirect()->route('instructor.dashboard'),
        default                        => redirect()->route('student.dashboard'),
    };
})->name('home');

// ── Admin ──────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('students', Admin\StudentController::class);
        Route::resource('courses',  Admin\CourseController::class);
    });

// ── Instructor ─────────────────────────────────────────────
Route::middleware(['auth', 'instructor'])
    ->prefix('instructor')
    ->name('instructor.')
    ->group(function () {
        Route::get('/dashboard', [Instructor\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('courses', Instructor\CourseController::class);
        Route::resource('courses.enrolments', Instructor\EnrolmentController::class)->shallow();
    });

// ── Student ────────────────────────────────────────────────
Route::middleware(['auth', 'student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        Route::get('/dashboard', [Student\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/courses',   [Student\CourseController::class, 'index'])->name('courses.index');
        Route::post('/courses/{course}/enrol', [Student\CourseController::class, 'enrol'])->name('courses.enrol');
        Route::get('/progress',  [Student\ProgressController::class, 'index'])->name('progress.index');
    });