<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Available courses</h2>
    </x-slot>

    <div class="py-8 max-w-6xl mx-auto px-4">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-md">{{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($courses as $course)
            <div class="bg-white rounded-lg shadow p-6 flex flex-col justify-between">
                <div>
                    <h3 class="font-semibold text-gray-900">{{ $course->title }}</h3>
                    <p class="text-sm text-gray-500 mt-1">by {{ $course->instructor->name }}</p>
                    <p class="text-sm text-gray-600 mt-2">{{ Str::limit($course->description, 100) }}</p>
                </div>
                <div class="mt-4">
                    @if(in_array($course->id, $enrolledIds))
                        <span class="px-3 py-1 text-sm bg-green-100 text-green-800 rounded-full">
                            Enrolled
                        </span>
                    @else
                        <form method="POST"
                              action="{{ route('student.courses.enrol', $course) }}">
                            @csrf
                            <button class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                                Enrol
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            @empty
            <p class="text-gray-500 col-span-3">No courses available right now.</p>
            @endforelse
        </div>
        <div class="mt-6">{{ $courses->links() }}</div>
    </div>
</x-app-layout>