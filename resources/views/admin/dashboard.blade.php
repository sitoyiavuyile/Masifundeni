<x-app-layout>
    <x-slot name="title">Admin Dashboard</x-slot>

    <x-slot name="header">
        <div class="page-header">
            <div>
                <h1 class="page-title">Dashboard</h1>
                <p class="page-subtitle">Welcome back, {{ auth()->user()->name }}</p>
            </div>
            <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg
                         bg-slate-100 dark:bg-slate-800 text-xs font-medium text-slate-600 dark:text-slate-400">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                </svg>
                {{ now()->format('d M Y') }}
            </span>
        </div>
    </x-slot>

    {{-- ── Stat cards ──────────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

        <x-stat-card label="Total Students" :value="$stats['total_students']" color="blue">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
            </svg>
        </x-stat-card>

        <x-stat-card label="Instructors" :value="$stats['total_instructors']" color="green">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>
            </svg>
        </x-stat-card>

        <x-stat-card label="Total Courses" :value="$stats['total_courses']" color="yellow">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>
            </svg>
        </x-stat-card>

        <x-stat-card label="Total Enrolments" :value="$stats['total_enrolments']" color="purple">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/>
            </svg>
        </x-stat-card>
    </div>

    {{-- ── Recent data panels ──────────────────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Recent students --}}
        <div class="card">
            <div class="card-header flex items-center justify-between">
                <h2 class="text-sm font-semibold text-slate-900 dark:text-slate-100">Recent Students</h2>
                <a href="{{ route('admin.students.index') }}"
                   class="text-xs font-medium text-blue-600 hover:text-blue-700
                          dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                    View all →
                </a>
            </div>
            <ul class="divide-y divide-slate-100 dark:divide-slate-700" role="list">
                @forelse($recentStudents as $student)
                <li>
                    <a href="{{ route('admin.students.show', $student) }}"
                       class="flex items-center gap-3 px-6 py-3.5 hover:bg-slate-50
                              dark:hover:bg-slate-700/40 transition-colors">
                        {{-- Avatar --}}
                        <span class="flex items-center justify-center w-9 h-9 rounded-full
                                     bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300
                                     text-xs font-semibold shrink-0"
                              aria-hidden="true">
                            {{ strtoupper(substr($student->name, 0, 2)) }}
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-slate-900 dark:text-slate-100 truncate">
                                {{ $student->name }}
                            </p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 truncate">
                                {{ $student->email }}
                            </p>
                        </div>
                        @if($student->studentProfile)
                            <x-badge :status="$student->studentProfile->status"/>
                        @endif
                    </a>
                </li>
                @empty
                <li class="px-6 py-8 text-center text-sm text-slate-400 dark:text-slate-500">
                    No students yet.
                </li>
                @endforelse
            </ul>
        </div>

        {{-- Recent courses --}}
        <div class="card">
            <div class="card-header flex items-center justify-between">
                <h2 class="text-sm font-semibold text-slate-900 dark:text-slate-100">Recent Courses</h2>
                <a href="{{ route('admin.courses.index') }}"
                   class="text-xs font-medium text-blue-600 hover:text-blue-700
                          dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                    View all →
                </a>
            </div>
            <ul class="divide-y divide-slate-100 dark:divide-slate-700" role="list">
                @forelse($recentCourses as $course)
                <li>
                    <a href="{{ route('admin.courses.show', $course) }}"
                       class="flex items-center gap-3 px-6 py-3.5 hover:bg-slate-50
                              dark:hover:bg-slate-700/40 transition-colors">
                        <span class="flex items-center justify-center w-9 h-9 rounded-lg
                                     bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300
                                     shrink-0"
                              aria-hidden="true">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>
                            </svg>
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-slate-900 dark:text-slate-100 truncate">
                                {{ $course->title }}
                            </p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 truncate">
                                {{ $course->instructor->name }}
                            </p>
                        </div>
                        <x-badge :status="$course->status"/>
                    </a>
                </li>
                @empty
                <li class="px-6 py-8 text-center text-sm text-slate-400 dark:text-slate-500">
                    No courses yet.
                </li>
                @endforelse
            </ul>
        </div>
    </div>

</x-app-layout>