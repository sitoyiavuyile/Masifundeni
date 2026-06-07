{{-- resources/views/student/dashboard.blade.php --}}
<x-app-layout>

    <x-slot name="header">
        <div class="page-header">
            <div>
                <h1 class="page-title">
                    Welcome back, {{ auth()->user()->name }}
                </h1>
                <p class="page-subtitle">Here’s your learning overview</p>
            </div>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-10 space-y-8">

        {{-- Stats --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <x-stat-card label="Enrolled"  :value="$stats['enrolled']"  color="indigo"/>
            <x-stat-card label="Active"    :value="$stats['active']"    color="green"/>
            <x-stat-card label="Completed" :value="$stats['completed']" color="yellow"/>
            <x-stat-card label="Dropped"   :value="$stats['dropped']"   color="red"/>

        </div>

        {{-- Courses card --}}
        <div class="card">

            {{-- Header --}}
            <div class="card-header flex items-center justify-between">

                <h3 class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                    My courses
                </h3>

                <a href="{{ route('student.courses.index') }}"
                   class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                    Browse more
                </a>

            </div>

            {{-- List --}}
            <ul class="divide-y divide-slate-100 dark:divide-slate-700">

                @forelse($enrolments as $enrolment)

                    <li class="px-6 py-4 flex items-center justify-between">

                        <div class="min-w-0">

                            <p class="text-sm font-medium text-slate-900 dark:text-slate-100 truncate">
                                {{ $enrolment->course->title }}
                            </p>

                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                by {{ $enrolment->course->instructor->name }}
                                · enrolled {{ $enrolment->enrolled_at?->format('d M Y') ?? '—' }}
                            </p>

                        </div>

                        <x-badge :status="$enrolment->status"/>

                    </li>

                @empty

                    <li class="px-6 py-6 text-sm text-slate-500 dark:text-slate-400">
                        You haven't enrolled in any courses yet.
                        <a href="{{ route('student.courses.index') }}"
                           class="text-blue-600 dark:text-blue-400 hover:underline ml-1">
                            Browse courses
                        </a>
                    </li>

                @endforelse

            </ul>

        </div>

    </div>

</x-app-layout>