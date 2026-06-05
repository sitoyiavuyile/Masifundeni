<?php
// app/Providers/AppServiceProvider.php

namespace App\Providers;

use App\Models\Course;
use App\Models\Enrolment;
use App\Models\Grade;
use App\Models\User;
use App\Observers\EnrolmentObserver;
use App\Observers\GradeObserver;
use App\Policies\CoursePolicy;
use App\Policies\EnrolmentPolicy;
use App\Policies\StudentPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Gate::policy(Course::class, CoursePolicy::class);
        Gate::policy(Enrolment::class, EnrolmentPolicy::class);
        Gate::policy(User::class, StudentPolicy::class);

        Gate::define('access-admin-panel', fn(User $user) => $user->isAdmin());

        Route::bind('student', function ($value) {
            return User::where('id', $value)
                ->where('role', 'student')
                ->firstOrFail();
        });

        Enrolment::observe(EnrolmentObserver::class);
        Grade::observe(GradeObserver::class);
    }
}