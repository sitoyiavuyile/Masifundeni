{{-- resources/views/layouts/sidebar.blade.php --}}
<aside class="w-64 bg-gray-900 text-white flex flex-col min-h-screen shrink-0">

    {{-- Logo --}}
    <div class="px-6 py-5 border-b border-gray-700">
        <span class="text-lg font-semibold tracking-tight">
            📚 SMS
        </span>
        <p class="text-xs text-gray-400 mt-1 capitalize">{{ auth()->user()->role }} panel</p>
    </div>

    {{-- Nav links --}}
    <nav class="flex-1 px-4 py-6 space-y-1">

        @if(auth()->user()->isAdmin())
            <x-nav-item :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                Dashboard
            </x-nav-item>
            <x-nav-item :href="route('admin.students.index')" :active="request()->routeIs('admin.students.*')">
                Students
            </x-nav-item>
            <x-nav-item :href="route('admin.courses.index')" :active="request()->routeIs('admin.courses.*')">
                Courses
            </x-nav-item>
        @endif

        @if(auth()->user()->isInstructor())
            <x-nav-item :href="route('instructor.dashboard')" :active="request()->routeIs('instructor.dashboard')">
                Dashboard
            </x-nav-item>
            <x-nav-item :href="route('instructor.courses.index')" :active="request()->routeIs('instructor.courses.*')">
                My Courses
            </x-nav-item>
        @endif

        @if(auth()->user()->isStudent())
            <x-nav-item :href="route('student.dashboard')" :active="request()->routeIs('student.dashboard')">
                Dashboard
            </x-nav-item>
            <x-nav-item :href="route('student.courses.index')" :active="request()->routeIs('student.courses.*')">
                Browse Courses
            </x-nav-item>
            <x-nav-item :href="route('student.progress.index')" :active="request()->routeIs('student.progress.*')">
                My Progress
            </x-nav-item>
        @endif

    </nav>

    {{-- Profile link at bottom --}}
    <div class="px-4 py-4 border-t border-gray-700">
        {{-- Profile page not implemented yet --}}
    </div>
</aside>