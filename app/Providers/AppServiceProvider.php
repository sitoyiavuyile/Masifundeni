<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Enrolment;
use App\Models\User;
use App\Policies\CoursePolicy;
use App\Policies\EnrolmentPolicy;
use App\Policies\StudentPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        Schema::defaultStringLength(191);

        Gate::policy(Course::class, CoursePolicy::class);
        Gate::policy(Enrolment::class, EnrolmentPolicy::class);
        Gate::policy(User::class, StudentPolicy::class);

        Gate::define('access-admin-panel', function (User $user) {
            return $user->isAdmin();
        });

        Route::bind('student', function ($value) {
            return \App\Models\User::where('id', $value)
                ->where('role', 'student')
                ->firstOrFail();
        });
    }
    
}