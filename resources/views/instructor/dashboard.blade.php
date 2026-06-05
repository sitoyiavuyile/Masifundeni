{{-- resources/views/instructor/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Instructor Dashboard</h2>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stat-card label="My courses"        :value="$stats['total_courses']"     color="indigo"/>
        <x-stat-card label="Published"         :value="$stats['published']"          color="green"/>
        <x-stat-card label="Total students"    :value="$stats['total_students']"     color="yellow"/>
        <x-stat-card label="Pending approvals" :value="$stats['pending_approvals']"  color="red"/>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- My courses --}}
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="font-semibold text-gray-700">My courses</h3>
                <a href="{{ route('instructor.courses.create') }}"
                   class="text-sm text-indigo-600 hover:underline">+ New</a>
            </div>
            <ul class="divide-y divide-gray-100">
                @forelse($courses as $course)
                <li class="px-6 py-3 flex items-center justify-between">
                    <div>
                        <a href="{{ route('instructor.courses.show', $course) }}"
                           class="text-sm font-medium text-gray-900 hover:text-indigo-600">
                            {{ $course->title }}
                        </a>
                        <p class="text-xs text-gray-500">{{ $course->enrolments_count }} students</p>
                    </div>
                    <x-badge :status="$course->status"/>
                </li>
                @empty
                <li class="px-6 py-4 text-sm text-gray-500">No courses yet.</li>
                @endforelse
            </ul>
        </div>

        {{-- Pending enrolments --}}
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="font-semibold text-gray-700">Pending approvals</h3>
            </div>
            <ul class="divide-y divide-gray-100">
                @forelse($pendingEnrolments as $enrolment)
                <li class="px-6 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $enrolment->student->name }}</p>
                        <p class="text-xs text-gray-500">{{ $enrolment->course->title }}</p>
                    </div>
                    <form method="POST"
                          action="{{ route('instructor.enrolments.update', $enrolment) }}">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="active">
                        <button class="text-xs px-3 py-1 bg-green-600 text-white rounded-full hover:bg-green-700">
                            Approve
                        </button>
                    </form>
                </li>
                @empty
                <li class="px-6 py-4 text-sm text-gray-500">No pending approvals.</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>