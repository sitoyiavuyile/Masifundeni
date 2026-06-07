<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-on-surface dark:text-inverse-on-surface">
            Create Course
        </h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-4">

        <form method="POST"
              action="{{ route('instructor.courses.store') }}"
              class="space-y-6">

            @csrf

            @include('instructor.courses._form')

            <div class="flex gap-3">

                <button type="submit"
                        class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-md text-sm">
                    Create Course
                </button>

                <a href="{{ route('instructor.courses.index') }}"
                   class="px-4 py-2 bg-surface-container text-on-surface-variant dark:bg-surface-container-high dark:text-inverse-on-surface rounded-md text-sm hover:bg-surface-container-highest transition">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</x-app-layout>