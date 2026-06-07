<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="h-full"
    x-data="{ sidebarOpen: false, darkMode: localStorage.getItem('darkMode') === 'true' }"
    x-init="$watch('darkMode', v => { localStorage.setItem('darkMode', v); document.documentElement.classList.toggle('dark', v) })"
    :class="{ 'dark': darkMode }"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Masifundeni') }} — {{ $title ?? 'Dashboard' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full bg-slate-50 dark:bg-slate-900 font-sans antialiased">

<a href="#main-content" class="skip-link">Skip to main content</a>

<div class="flex h-full min-h-screen">

    {{-- Backdrop --}}
    <div
        x-show="sidebarOpen"
        class="fixed inset-0 z-40 bg-slate-900/60 lg:hidden"
        @click="sidebarOpen = false"
    ></div>

    {{-- Sidebar --}}
    <aside
        class="fixed inset-y-0 left-0 z-50 w-72 lg:static lg:translate-x-0
               transform transition-transform duration-200 ease-in-out
               bg-slate-900 dark:bg-slate-950"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >
        @include('layouts.sidebar')
    </aside>

    {{-- Main area --}}
    <div class="flex flex-1 flex-col min-w-0 overflow-hidden">

        {{-- Top Navbar (ONLY NAV CONTROLS HERE) --}}
        <header class="sticky top-0 z-30 flex h-16 items-center gap-4
                       bg-white/80 dark:bg-slate-900/80 backdrop-blur-md
                       border-b border-slate-200 dark:border-slate-800
                       px-4 sm:px-6 lg:px-8">

            <button
                type="button"
                class="lg:hidden w-10 h-10 flex items-center justify-center rounded-lg"
                @click="sidebarOpen = true"
            >
                ☰
            </button>

            <div class="ml-auto flex items-center gap-3">

                {{-- Dark mode --}}
                <button @click="darkMode = !darkMode" class="w-9 h-9 rounded-lg">
                    🌙
                </button>

                {{-- User --}}
                <div class="text-sm text-slate-700 dark:text-slate-300">
                    {{ auth()->user()->name }}
                </div>

            </div>
        </header>

        {{-- Flash Messages --}}
        <div class="px-4 sm:px-6 lg:px-8 pt-4 space-y-2">
            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif
        </div>

        {{-- ✅ PAGE HEADER (FIXED POSITION) --}}
        @if (isset($header))
            <div class="px-4 sm:px-6 lg:px-8 pt-6">
                {{ $header }}
            </div>
        @endif

        {{-- Page content --}}
        <main id="main-content"
              class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8"
              tabindex="-1">

            {{ $slot }}

        </main>

    </div>
</div>

</body>
</html>