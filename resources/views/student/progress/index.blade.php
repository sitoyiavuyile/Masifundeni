{{-- resources/views/student/progress/index.blade.php --}}
<x-app-layout>

    <x-slot name="header">
        <div class="page-header">
            <div>
                <h1 class="page-title">My Progress</h1>
                <p class="page-subtitle">Track your performance across enrolled courses</p>
            </div>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-10 space-y-6">

        @forelse($enrolments as $enrolment)

            <div class="card overflow-hidden">

                {{-- Header --}}
                <div class="card-header flex items-center justify-between">

                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-slate-100">
                            {{ $enrolment->course->title }}
                        </h3>

                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                            {{ $enrolment->course->instructor->name }}
                        </p>
                    </div>

                    <div class="text-right space-y-1">
                        <x-badge :status="$enrolment->status"/>

                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">
                            Overall: {{ $enrolment->average_score }}%
                        </p>
                    </div>

                </div>

                {{-- Body --}}
                <div class="card-body p-0">

                    @if($enrolment->grades->isNotEmpty())

                        <div class="table-wrapper rounded-none border-0">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Assessment</th>
                                        <th>Score</th>
                                        <th>Out of</th>
                                        <th>%</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($enrolment->grades as $grade)
                                        <tr>
                                            <td class="text-slate-900 dark:text-slate-100">
                                                {{ $grade->label }}
                                            </td>

                                            <td>{{ $grade->score }}</td>
                                            <td>{{ $grade->max_score }}</td>
                                            <td>{{ $grade->percentage }}%</td>

                                            <td>
                                                <span class="font-semibold
                                                    {{ in_array($grade->letter_grade, ['A','B']) ? 'text-green-500 dark:text-green-400' : '' }}
                                                    {{ $grade->letter_grade === 'C' ? 'text-yellow-500 dark:text-yellow-400' : '' }}
                                                    {{ in_array($grade->letter_grade, ['D','F']) ? 'text-red-500 dark:text-red-400' : '' }}">
                                                    {{ $grade->letter_grade }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    @else
                        <div class="px-6 py-5 text-sm text-slate-500 dark:text-slate-400">
                            No grades recorded yet.
                        </div>
                    @endif

                </div>
            </div>

        @empty

            <div class="card">
                <div class="card-body text-center py-10 text-slate-500 dark:text-slate-400">
                    You haven't enrolled in any courses.

                    <div class="mt-3">
                        <a href="{{ route('student.courses.index') }}"
                           class="text-blue-600 dark:text-blue-400 hover:underline">
                            Browse courses
                        </a>
                    </div>
                </div>
            </div>

        @endforelse

    </div>

</x-app-layout>