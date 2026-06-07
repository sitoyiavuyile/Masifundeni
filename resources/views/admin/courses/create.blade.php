{{-- resources/views/admin/courses/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Create Course</h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-4">
        <form method="POST" action="{{ route('admin.courses.store') }}" class="space-y-6">
            @csrf
            @include('admin.courses._form')
            <div class="flex gap-3">
                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                    Create Course
                </button>
                <a href="{{ route('admin.courses.index') }}"
                   class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>