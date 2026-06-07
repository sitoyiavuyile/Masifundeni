<x-app-layout>
    <x-slot name="title">Courses</x-slot>

    <x-slot name="header">
        <div class="page-header">
            <div>
                <h1 class="page-title">Courses</h1>
                <p class="page-subtitle">All courses across the platform</p>
            </div>
            <a href="{{ route('admin.courses.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                New course
            </a>
        </div>
    </x-slot>

    <div class="card">
        <div class="table-wrapper">
            <table class="table" aria-label="Courses list">
                <thead>
                    <tr>
                        <th scope="col">Course</th>
                        <th scope="col" class="hidden sm:table-cell">Instructor</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="hidden md:table-cell">Students</th>
                        <th scope="col"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <span class="flex items-center justify-center w-9 h-9 rounded-lg
                                             bg-amber-100 dark:bg-amber-900/40
                                             text-amber-700 dark:text-amber-300 shrink-0"
                                      aria-hidden="true">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>
                                    </svg>
                                </span>
                                <p class="font-medium text-slate-900 dark:text-slate-100 truncate max-w-[200px]">
                                    {{ $course->title }}
                                </p>
                            </div>
                        </td>
                        <td class="hidden sm:table-cell text-slate-600 dark:text-slate-400">
                            {{ $course->instructor->name }}
                        </td>
                        <td><x-badge :status="$course->status"/></td>
                        <td class="hidden md:table-cell">
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300 tabular-nums">
                                {{ $course->enrolments->count() }}
                            </span>
                        </td>
                        <td>
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.courses.show', $course) }}"
                                   class="inline-flex items-center justify-center w-8 h-8 rounded-lg
                                          text-slate-500 hover:text-blue-600 hover:bg-blue-50
                                          dark:text-slate-400 dark:hover:text-blue-400 dark:hover:bg-blue-900/30
                                          transition-colors"
                                   aria-label="View {{ $course->title }}">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.courses.edit', $course) }}"
                                   class="inline-flex items-center justify-center w-8 h-8 rounded-lg
                                          text-slate-500 hover:text-amber-600 hover:bg-amber-50
                                          dark:text-slate-400 dark:hover:text-amber-400 dark:hover:bg-amber-900/30
                                          transition-colors"
                                   aria-label="Edit {{ $course->title }}">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l .8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                                    </svg>
                                </a>
                                <form method="POST"
                                      action="{{ route('admin.courses.destroy', $course) }}"
                                      onsubmit="return confirm('Delete {{ addslashes($course->title) }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg
                                                   text-slate-500 hover:text-red-600 hover:bg-red-50
                                                   dark:text-slate-400 dark:hover:text-red-400 dark:hover:bg-red-900/30
                                                   transition-colors"
                                            aria-label="Delete {{ $course->title }}">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <svg class="mx-auto w-10 h-10 text-slate-300 dark:text-slate-600 mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>
                            </svg>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">No courses yet</p>
                            <a href="{{ route('admin.courses.create') }}"
                               class="mt-3 inline-block text-xs font-medium text-blue-600 hover:underline dark:text-blue-400">
                                Create your first course →
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($courses->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-700">
            {{ $courses->links() }}
        </div>
        @endif
    </div>

</x-app-layout>