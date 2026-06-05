<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">{{ $course->title }}</h2>
    </x-slot>
    <div class="py-8 max-w-4xl mx-auto px-4 space-y-6">
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600">{{ $course->description ?? 'No description.' }}</p>
            <div class="mt-4">
                <span class="px-2 py-1 text-xs rounded-full
                    {{ $course->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ ucfirst($course->status) }}
                </span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 font-medium">
                Enrolled students ({{ $course->enrolments->count() }})
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Enrolled</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($course->enrolments as $enrolment)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="font-medium">{{ $enrolment->student->name }}</div>
                            <div class="text-sm text-gray-500">{{ $enrolment->student->email }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm">{{ ucfirst($enrolment->status) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $enrolment->enrolled_at?->format('d M Y') ?? '—' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-sm text-gray-500">No students enrolled yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>