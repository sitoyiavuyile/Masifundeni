<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold">My Courses</h2>
            <a href="{{ route('instructor.courses.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                New course
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Students</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($courses as $course)
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $course->title }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full
                                {{ $course->status === 'published' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $course->status === 'draft'     ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $course->status === 'archived'  ? 'bg-gray-100 text-gray-800' : '' }}">
                                {{ ucfirst($course->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $course->enrolments_count ?? $course->enrolments->count() }}
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('instructor.courses.show', $course) }}"
                               class="text-sm text-indigo-600 hover:underline">View</a>
                            <a href="{{ route('instructor.courses.edit', $course) }}"
                               class="text-sm text-yellow-600 hover:underline">Edit</a>
                            <form method="POST"
                                  action="{{ route('instructor.courses.destroy', $course) }}"
                                  class="inline"
                                  onsubmit="return confirm('Delete this course?')">
                                @csrf @method('DELETE')
                                <button class="text-sm text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $courses->links() }}</div>
    </div>
</x-app-layout>