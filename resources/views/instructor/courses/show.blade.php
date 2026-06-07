{{-- resources/views/instructor/courses/show.blade.php --}}
<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                {{ $course->title }}
            </h2>

            <span class="text-xs text-gray-500 dark:text-slate-400 bg-gray-100 dark:bg-slate-800 px-3 py-1 rounded-full">
                Course Overview
            </span>
        </div>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto px-4 space-y-6">

        {{-- COURSE INFO --}}
        <div class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-700 rounded-lg shadow overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-700">
                <h3 class="font-semibold text-gray-700 dark:text-white">
                    Course Details
                </h3>
            </div>

            <div class="p-6 space-y-4">

                <p class="text-gray-600 dark:text-slate-300 leading-relaxed">
                    {{ $course->description ?? 'No description provided.' }}
                </p>

                @php
                    $statusColor = match($course->status) {
                        'published' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                        'draft' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                        default => 'bg-gray-100 text-gray-700 dark:bg-slate-800 dark:text-slate-300'
                    };
                @endphp

                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusColor }}">
                    {{ ucfirst($course->status) }}
                </span>

            </div>
        </div>

        {{-- ENROLMENTS --}}
        <div class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-700 rounded-lg shadow overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-700 flex justify-between items-center">

                <h3 class="font-semibold text-gray-700 dark:text-white">
                    Enrolled Students
                </h3>

                <span class="text-xs text-gray-500 dark:text-slate-400">
                    {{ $course->enrolments->count() }} students
                </span>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-100 dark:divide-slate-700">

                    <thead class="bg-gray-50 dark:bg-slate-800">
                        <tr>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-300 uppercase">
                                Student
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-300 uppercase">
                                Status
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-300 uppercase">
                                Enrolled
                            </th>

                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 dark:divide-slate-700 bg-white dark:bg-slate-900">

                        @forelse($course->enrolments as $enrolment)

                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition">

                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900 dark:text-white">
                                        {{ $enrolment->student->name }}
                                    </div>

                                    <div class="text-xs text-gray-500 dark:text-slate-400">
                                        {{ $enrolment->student->email }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 dark:bg-slate-800 dark:text-slate-300">
                                        {{ ucfirst($enrolment->status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-slate-400">
                                    {{ $enrolment->enrolled_at?->format('d M Y') ?? '—' }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500 dark:text-slate-400">
                                    No students enrolled yet
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>