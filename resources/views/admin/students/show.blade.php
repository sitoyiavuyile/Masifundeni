<x-app-layout>
    <x-slot name="title">{{ $student->name }}</x-slot>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.students.index') }}"
               class="inline-flex items-center justify-center w-8 h-8 rounded-lg
                      text-slate-500 hover:text-slate-700 hover:bg-slate-100
                      dark:text-slate-400 dark:hover:bg-slate-800 transition-colors"
               aria-label="Back to students">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                </svg>
            </a>
            <div>
                <h1 class="page-title">{{ $student->name }}</h1>
                <p class="page-subtitle font-mono text-xs">
                    {{ $student->studentProfile?->student_number ?? 'No student number' }}
                </p>
            </div>
            <div class="ml-auto flex items-center gap-2">
                @if($student->studentProfile)
                    <x-badge :status="$student->studentProfile->status"/>
                @endif
                <a href="{{ route('admin.students.edit', $student) }}" class="btn-secondary btn-sm">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                    </svg>
                    Edit
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl space-y-6">

        {{-- Profile card --}}
        <div class="card">
            <div class="card-header">
                <h2 class="text-sm font-semibold text-slate-900 dark:text-slate-100">Profile details</h2>
            </div>
            <div class="card-body grid grid-cols-1 sm:grid-cols-2 gap-5">
                @foreach([
                    ['Email',         $student->email],
                    ['Phone',         $student->studentProfile?->phone ?? '—'],
                    ['Date of birth', $student->studentProfile?->date_of_birth?->format('d M Y') ?? '—'],
                    ['Joined',        $student->created_at->format('d M Y')],
                ] as [$label, $value])
                <div>
                    <dt class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                        {{ $label }}
                    </dt>
                    <dd class="mt-1 text-sm font-medium text-slate-900 dark:text-slate-100">
                        {{ $value }}
                    </dd>
                </div>
                @endforeach

                <div class="sm:col-span-2">
                    <dt class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                        Address
                    </dt>
                    <dd class="mt-1 text-sm text-slate-900 dark:text-slate-100 whitespace-pre-line">
                        {{ $student->studentProfile?->address ?? '—' }}
                    </dd>
                </div>
            </div>
        </div>

        {{-- Enrolments --}}
        <div class="card">
            <div class="card-header">
                <h2 class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                    Enrolments
                    <span class="ml-1.5 inline-flex items-center justify-center px-2 py-0.5
                                 rounded-full bg-slate-100 dark:bg-slate-700
                                 text-xs font-medium text-slate-600 dark:text-slate-300">
                        {{ $student->enrolments->count() }}
                    </span>
                </h2>
            </div>
            <div class="table-wrapper rounded-t-none border-0 border-t border-slate-100 dark:border-slate-700">
                <table class="table" aria-label="Student enrolments">
                    <thead>
                        <tr>
                            <th scope="col">Course</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="hidden sm:table-cell">Enrolled</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($student->enrolments as $enrolment)
                        <tr>
                            <td class="font-medium text-slate-900 dark:text-slate-100">
                                {{ $enrolment->course->title }}
                            </td>
                            <td><x-badge :status="$enrolment->status"/></td>
                            <td class="hidden sm:table-cell text-slate-500 dark:text-slate-400">
                                {{ $enrolment->enrolled_at?->format('d M Y') ?? '—' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-sm text-slate-400 dark:text-slate-500">
                                Not enrolled in any courses.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>