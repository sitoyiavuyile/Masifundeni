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

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::policy(Course::class, CoursePolicy::class);
        Gate::policy(Enrolment::class, EnrolmentPolicy::class);
        Gate::policy(User::class, StudentPolicy::class);

        Gate::define('access-admin-panel', function (User $user) {
            return $user->isAdmin();
        });
    }
    
}