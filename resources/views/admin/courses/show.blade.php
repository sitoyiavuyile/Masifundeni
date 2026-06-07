<x-app-layout>
    <x-slot name="title">{{ $course->title }}</x-slot>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.courses.index') }}"
               class="inline-flex items-center justify-center w-8 h-8 rounded-lg
                      text-slate-500 hover:text-slate-700 hover:bg-slate-100
                      dark:text-slate-400 dark:hover:bg-slate-800 transition-colors"
               aria-label="Back to courses">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                </svg>
            </a>
            <div class="min-w-0">
                <h1 class="page-title truncate">{{ $course->title }}</h1>
                <p class="page-subtitle">by {{ $course->instructor->name }}</p>
            </div>
            <div class="ml-auto flex items-center gap-2 shrink-0">
                <x-badge :status="$course->status"/>
                <a href="{{ route('admin.courses.edit', $course) }}" class="btn-secondary btn-sm">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                    </svg>
                    Edit
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl space-y-6">

        {{-- Course info card --}}
        <div class="card">
            <div class="card-header">
                <h2 class="text-sm font-semibold text-slate-900 dark:text-slate-100">Course details</h2>
            </div>
            <div class="card-body">
                @if($course->description)
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        {{ $course->description }}
                    </p>
                @else
                    <p class="text-sm text-slate-400 dark:text-slate-500 italic">No description provided.</p>
                @endif

                <dl class="mt-5 grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <div>
                        <dt class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                            Instructor
                        </dt>
                        <dd class="mt-1 text-sm font-medium text-slate-900 dark:text-slate-100">
                            {{ $course->instructor->name }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                            Total students
                        </dt>
                        <dd class="mt-1 text-sm font-bold text-slate-900 dark:text-slate-100 tabular-nums">
                            {{ $course->enrolments->count() }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                            Created
                        </dt>
                        <dd class="mt-1 text-sm text-slate-900 dark:text-slate-100">
                            {{ $course->created_at->format('d M Y') }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        {{-- Enrolments table --}}
        <div class="card">
            <div class="card-header">
                <h2 class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                    Enrolled students
                    <span class="ml-1.5 inline-flex items-center justify-center px-2 py-0.5
                                 rounded-full bg-slate-100 dark:bg-slate-700
                                 text-xs font-medium text-slate-600 dark:text-slate-300">
                        {{ $course->enrolments->count() }}
                    </span>
                </h2>
            </div>
            <div class="table-wrapper rounded-t-none border-0 border-t border-slate-100 dark:border-slate-700">
                <table class="table" aria-label="Enrolled students">
                    <thead>
                        <tr>
                            <th scope="col">Student</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="hidden sm:table-cell">Enrolled</th>
                            <th scope="col" class="hidden md:table-cell">Completed</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($course->enrolments as $enrolment)
                        <tr>
                            <td>
                                <div class="flex items-center gap-2.5">
                                    <span class="flex items-center justify-center w-7 h-7 rounded-full
                                                 bg-blue-100 dark:bg-blue-900/40
                                                 text-blue-700 dark:text-blue-300
                                                 text-xs font-semibold shrink-0"
                                          aria-hidden="true">
                                        {{ strtoupper(substr($enrolment->student->name, 0, 2)) }}
                                    </span>
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-slate-900 dark:text-slate-100 truncate">
                                            {{ $enrolment->student->name }}
                                        </p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 truncate">
                                            {{ $enrolment->student->email }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td><x-badge :status="$enrolment->status"/></td>
                            <td class="hidden sm:table-cell text-slate-500 dark:text-slate-400">
                                {{ $enrolment->enrolled_at?->format('d M Y') ?? '—' }}
                            </td>
                            <td class="hidden md:table-cell text-slate-500 dark:text-slate-400">
                                {{ $enrolment->completed_at?->format('d M Y') ?? '—' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-sm text-slate-400 dark:text-slate-500">
                                No students enrolled yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>