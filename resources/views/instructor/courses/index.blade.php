{{-- resources/views/instructor/courses/index.blade.php --}}
<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                My Courses
            </h2>

            <a href="{{ route('instructor.courses.create') }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm transition">
                New course
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4">

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        {{-- TABLE CARD --}}
        <div class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-700 rounded-lg shadow overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-700">
                <h3 class="font-semibold text-gray-700 dark:text-white">
                    Course List
                </h3>
            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-100 dark:divide-slate-700">

                    <thead class="bg-gray-50 dark:bg-slate-800">
                        <tr>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-300 uppercase">
                                Title
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-300 uppercase">
                                Status
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-300 uppercase">
                                Students
                            </th>

                            <th class="px-6 py-3"></th>

                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 dark:divide-slate-700 bg-white dark:bg-slate-900">

                        @forelse($courses as $course)

                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition">

                                {{-- TITLE --}}
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $course->title }}
                                </td>

                                {{-- STATUS --}}
                                <td class="px-6 py-4">
                                    @php
                                        $statusClass = match($course->status) {
                                            'published' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                            'draft' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                                            'archived' => 'bg-gray-100 text-gray-700 dark:bg-slate-800 dark:text-slate-300',
                                            default => 'bg-gray-100 text-gray-700 dark:bg-slate-800 dark:text-slate-300'
                                        };
                                    @endphp

                                    <span class="px-2 py-1 text-xs rounded-full font-medium {{ $statusClass }}">
                                        {{ ucfirst($course->status) }}
                                    </span>
                                </td>

                                {{-- STUDENTS --}}
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-slate-400">
                                    {{ $course->enrolments_count ?? $course->enrolments->count() }}
                                </td>

                                {{-- ACTIONS --}}
                                <td class="px-6 py-4 text-right space-x-3">

                                    <a href="{{ route('instructor.courses.show', $course) }}"
                                       class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                                        View
                                    </a>

                                    <a href="{{ route('instructor.courses.edit', $course) }}"
                                       class="text-sm text-yellow-600 dark:text-yellow-400 hover:underline">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('instructor.courses.destroy', $course) }}"
                                          class="inline"
                                          onsubmit="return confirm('Delete this course?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="text-sm text-red-600 dark:text-red-400 hover:underline">
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-slate-400">
                                    No courses found. Create your first course.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- PAGINATION --}}
        <div class="mt-4">
            {{ $courses->links() }}
        </div>

    </div>

</x-app-layout>