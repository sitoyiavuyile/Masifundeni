<x-app-layout>
    <x-slot name="header">
        <div class="page-header">
            <div>
                <h1 class="page-title">Available courses</h1>
                <p class="page-subtitle">Browse and enrol in available courses</p>
            </div>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-10">

        {{-- Alerts --}}
        <div class="space-y-2 mb-6" aria-live="polite">
            @if(session('success'))
                <div class="alert-success">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert-error">
                    <span>{{ session('error') }}</span>
                </div>
            @endif
        </div>

        {{-- Courses grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($courses as $course)
                <div class="card flex flex-col justify-between">

                    {{-- Content --}}
                    <div class="card-body">

                        <h3 class="text-base font-semibold text-slate-900 dark:text-slate-100">
                            {{ $course->title }}
                        </h3>

                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                            by {{ $course->instructor->name }}
                        </p>

                        <p class="text-sm text-slate-600 dark:text-slate-300 mt-3">
                            {{ Str::limit($course->description, 120) }}
                        </p>
                    </div>

                    {{-- Footer action --}}
                    <div class="px-6 pb-6">

                        @if(in_array($course->id, $enrolledIds))
                            <span class="inline-flex items-center px-3 py-1 text-xs font-medium
                                         bg-green-100 text-green-700 rounded-full
                                         dark:bg-green-900/30 dark:text-green-300">
                                Enrolled
                            </span>
                        @else
                            <form method="POST" action="{{ route('student.courses.enrol', $course) }}">
                                @csrf

                                <button type="submit" class="btn-primary w-full">
                                    Enrol
                                </button>
                            </form>
                        @endif

                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-slate-500 dark:text-slate-400">
                        No courses available right now.
                    </p>
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $courses->links() }}
        </div>

    </div>
</x-app-layout>