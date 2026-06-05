{{-- resources/views/admin/courses/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold">
                {{ $course->title }}
            </h2>

            <a href="{{ route('admin.courses.edit', $course) }}"
               class="px-4 py-2 bg-yellow-500 text-white rounded-md text-sm">
                Edit
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 space-y-6">

        {{-- Course Details --}}
        <div class="bg-white rounded-lg shadow p-6 grid grid-cols-2 gap-4">

            <div class="col-span-2">
                <p class="text-xs text-gray-500 uppercase">Course Title</p>
                <p class="font-medium">{{ $course->title }}</p>
            </div>

            <div class="col-span-2">
                <p class="text-xs text-gray-500 uppercase">Description</p>
                <p class="font-medium text-gray-700">
                    {{ $course->description ?? '—' }}
                </p>
            </div>

            <div>
                <p class="text-xs text-gray-500 uppercase">Status</p>
                <x-badge :status="$course->status ?? 'draft'"/>
            </div>

            <div>
                <p class="text-xs text-gray-500 uppercase">Created</p>
                <p class="font-medium">
                    {{ $course->created_at?->format('d M Y') }}
                </p>
            </div>

        </div>

        {{-- Enrolments --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 font-medium">
                Enrolled Students
            </div>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Student
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Enrolled At
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($course->enrolments as $enrolment)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium">
                                {{ $enrolment->student->name }}
                            </td>

                            <td class="px-6 py-4">
                                <x-badge :status="$enrolment->status"/>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $enrolment->enrolled_at?->format('d M Y') ?? '—' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-sm text-gray-500">
                                No students enrolled in this course.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>