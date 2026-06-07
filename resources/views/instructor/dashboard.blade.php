{{-- resources/views/instructor/dashboard.blade.php --}}
<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                Instructor Dashboard
            </h2>

            <span class="text-xs text-gray-500 dark:text-slate-400 bg-gray-100 dark:bg-slate-800 px-3 py-1 rounded-full">
                Overview
            </span>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 space-y-8">

        {{-- STATS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-700 rounded-lg shadow p-6">
                <p class="text-sm text-gray-500 dark:text-slate-400">My Courses</p>
                <h3 class="text-2xl font-semibold text-indigo-600 dark:text-indigo-400 mt-1">
                    {{ $stats['total_courses'] }}
                </h3>
            </div>

            <div class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-700 rounded-lg shadow p-6">
                <p class="text-sm text-gray-500 dark:text-slate-400">Published</p>
                <h3 class="text-2xl font-semibold text-green-600 dark:text-green-400 mt-1">
                    {{ $stats['published'] }}
                </h3>
            </div>

            <div class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-700 rounded-lg shadow p-6">
                <p class="text-sm text-gray-500 dark:text-slate-400">Total Students</p>
                <h3 class="text-2xl font-semibold text-yellow-500 dark:text-yellow-400 mt-1">
                    {{ $stats['total_students'] }}
                </h3>
            </div>

            <div class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-700 rounded-lg shadow p-6">
                <p class="text-sm text-gray-500 dark:text-slate-400">Pending Approvals</p>
                <h3 class="text-2xl font-semibold text-red-500 dark:text-red-400 mt-1">
                    {{ $stats['pending_approvals'] }}
                </h3>
            </div>

        </div>

        {{-- MAIN GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- MY COURSES --}}
            <div class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-700 rounded-lg shadow overflow-hidden">

                <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-700 flex justify-between items-center">
                    <h3 class="font-semibold text-gray-700 dark:text-white">
                        My Courses
                    </h3>

                    <a href="{{ route('instructor.courses.create') }}"
                       class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                        + New Course
                    </a>
                </div>

                <ul class="divide-y divide-gray-100 dark:divide-slate-700">

                    @forelse($courses as $course)
                        <li class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-slate-800 transition">

                            <div>
                                <a href="{{ route('instructor.courses.show', $course) }}"
                                   class="text-sm font-medium text-gray-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400">
                                    {{ $course->title }}
                                </a>

                                <p class="text-xs text-gray-500 dark:text-slate-400 mt-1">
                                    {{ $course->enrolments_count }} students
                                </p>
                            </div>

                            <x-badge :status="$course->status"/>

                        </li>
                    @empty

                        <li class="px-6 py-6 text-center text-sm text-gray-500 dark:text-slate-400">
                            No courses yet. Create your first course.
                        </li>

                    @endforelse

                </ul>
            </div>

            {{-- PENDING ENROLMENTS --}}
            <div class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-700 rounded-lg shadow overflow-hidden">

                <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-700">
                    <h3 class="font-semibold text-gray-700 dark:text-white">
                        Pending Approvals
                    </h3>
                </div>

                <ul class="divide-y divide-gray-100 dark:divide-slate-700">

                    @forelse($pendingEnrolments as $enrolment)
                        <li class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-slate-800 transition">

                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $enrolment->student->name }}
                                </p>

                                <p class="text-xs text-gray-500 dark:text-slate-400">
                                    {{ $enrolment->course->title }}
                                </p>
                            </div>

                            <form method="POST"
                                  action="{{ route('instructor.enrolments.update', $enrolment) }}">

                                @csrf
                                @method('PUT')

                                <input type="hidden" name="status" value="active">

                                <button class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs rounded-md transition">
                                    Approve
                                </button>

                            </form>

                        </li>

                    @empty

                        <li class="px-6 py-6 text-center text-sm text-gray-500 dark:text-slate-400">
                            No pending approvals
                        </li>

                    @endforelse

                </ul>

            </div>

        </div>

    </div>

</x-app-layout>