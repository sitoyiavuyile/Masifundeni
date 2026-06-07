<x-app-layout>
    <x-slot name="title">Edit — {{ $course->title }}</x-slot>

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
            <div>
                <h1 class="page-title">Edit Course</h1>
                <p class="page-subtitle">{{ $course->title }}</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl">
        <form method="POST" action="{{ route('admin.courses.update', $course) }}" novalidate>
            @csrf @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h2 class="text-sm font-semibold text-slate-900 dark:text-slate-100">Course details</h2>
                </div>
                <div class="card-body">
                    @include('admin.courses._form')
                </div>
            </div>
            <div class="flex items-center gap-3 mt-6">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9"/>
                    </svg>
                    Save changes
                </button>
                <a href="{{ route('admin.courses.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

</x-app-layout>