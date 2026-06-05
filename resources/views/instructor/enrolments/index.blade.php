<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Enrolments — {{ $course->title }}</h2>
    </x-slot>

    <div class="py-8 max-w-6xl mx-auto px-4">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Enrolled</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($enrolments as $enrolment)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="font-medium">{{ $enrolment->student->name }}</div>
                            <div class="text-sm text-gray-500">{{ $enrolment->student->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST"
                                  action="{{ route('instructor.enrolments.update', $enrolment) }}">
                                @csrf @method('PUT')
                                <select name="status"
                                        onchange="this.form.submit()"
                                        class="text-sm rounded-md border-gray-300">
                                    @foreach(['pending','active','completed','dropped'] as $s)
                                        <option value="{{ $s }}"
                                            {{ $enrolment->status === $s ? 'selected' : '' }}>
                                            {{ ucfirst($s) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $enrolment->enrolled_at?->format('d M Y') ?? '—' }}
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST"
                                  action="{{ route('instructor.enrolments.destroy', $enrolment) }}"
                                  onsubmit="return confirm('Remove this student?')">
                                @csrf @method('DELETE')
                                <button class="text-sm text-red-600 hover:underline">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-sm text-gray-500">No enrolments yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $enrolments->links() }}</div>
    </div>
</x-app-layout>