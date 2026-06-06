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

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-slate-50 dark:bg-slate-900 font-sans antialiased">

    {{-- Skip link (accessibility) --}}
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <div class="flex h-full min-h-screen">

        {{-- ── Mobile sidebar backdrop ─────────────────────────────── --}}
        <div
            x-show="sidebarOpen"
            x-transition:enter="transition-opacity ease-linear duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden"
            @click="sidebarOpen = false"
            aria-hidden="true"
        ></div>

        {{-- ── Sidebar ──────────────────────────────────────────────── --}}
        <aside
            id="sidebar"
            role="navigation"
            aria-label="Main navigation"
            class="fixed inset-y-0 left-0 z-50 w-72 flex-shrink-0
                   transform transition-transform duration-200 ease-in-out
                   lg:static lg:translate-x-0
                   bg-slate-900 dark:bg-slate-950"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            @include('layouts.sidebar')
        </aside>

        {{-- ── Main area ────────────────────────────────────────────── --}}
        <div class="flex flex-1 flex-col min-w-0 overflow-hidden">

            {{-- Top bar --}}
            <header class="sticky top-0 z-30 flex h-16 items-center gap-4
                           bg-white/80 dark:bg-slate-900/80 backdrop-blur-md
                           border-b border-slate-200 dark:border-slate-800
                           px-4 sm:px-6 lg:px-8">

                {{-- Mobile hamburger --}}
                <button
                    type="button"
                    class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg
                           text-slate-500 hover:text-slate-700 hover:bg-slate-100
                           dark:text-slate-400 dark:hover:text-slate-200 dark:hover:bg-slate-800
                           transition-colors focus-visible:ring-2 focus-visible:ring-blue-500"
                    @click="sidebarOpen = true"
                    aria-label="Open sidebar"
                    aria-expanded="false"
                    :aria-expanded="sidebarOpen.toString()"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                </button>

                {{-- Page heading slot --}}
                <div class="flex-1 min-w-0">
                    @isset($header)
                        {{ $header }}
                    @endisset
                </div>

                {{-- Right actions --}}
                <div class="flex items-center gap-2 sm:gap-3 ml-auto">

                    {{-- Dark mode toggle --}}
                    <button
                        type="button"
                        @click="darkMode = !darkMode"
                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg
                               text-slate-500 hover:text-slate-700 hover:bg-slate-100
                               dark:text-slate-400 dark:hover:text-slate-200 dark:hover:bg-slate-800
                               transition-colors focus-visible:ring-2 focus-visible:ring-blue-500"
                        :aria-label="darkMode ? 'Switch to light mode' : 'Switch to dark mode'"
                    >
                        {{-- Sun icon --}}
                        <svg x-show="darkMode" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/>
                        </svg>
                        {{-- Moon icon --}}
                        <svg x-show="!darkMode" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z"/>
                        </svg>
                    </button>

                    {{-- User menu --}}
                    <div class="relative" x-data="{ open: false }">
                        <button
                            type="button"
                            @click="open = !open"
                            class="flex items-center gap-2.5 rounded-lg px-2 py-1.5
                                   text-sm font-medium text-slate-700
                                   hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800
                                   transition-colors focus-visible:ring-2 focus-visible:ring-blue-500"
                            :aria-expanded="open.toString()"
                            aria-haspopup="true"
                        >
                            {{-- Avatar --}}
                            <span class="flex items-center justify-center w-8 h-8 rounded-full
                                         bg-blue-600 text-white text-xs font-semibold select-none"
                                  aria-hidden="true">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </span>
                            <span class="hidden sm:block max-w-[120px] truncate">
                                {{ auth()->user()->name }}
                            </span>
                            <svg class="w-4 h-4 text-slate-400 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                            </svg>
                        </button>

                        {{-- Dropdown --}}
                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            @click.outside="open = false"
                            class="absolute right-0 mt-2 w-52 rounded-xl bg-white dark:bg-slate-800
                                   border border-slate-100 dark:border-slate-700
                                   shadow-lg shadow-slate-900/10 py-1 z-50"
                            role="menu"
                            aria-orientation="vertical"
                        >
                            <div class="px-4 py-2.5 border-b border-slate-100 dark:border-slate-700">
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                                    Signed in as
                                </p>
                                <p class="text-sm font-semibold text-slate-900 dark:text-slate-100 truncate mt-0.5">
                                    {{ auth()->user()->email }}
                                </p>
                                <span class="inline-flex mt-1 px-2 py-0.5 text-xs font-medium rounded-full
                                             bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300 capitalize">
                                    {{ auth()->user()->role }}
                                </span>
                            </div>

                            <a href="{{ route('profile.edit') }}"
                               class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-700
                                      hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-700/60
                                      transition-colors"
                               role="menuitem">
                                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                                Profile settings
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-100 dark:border-slate-700 mt-1">
                                @csrf
                                <button type="submit"
                                        class="flex w-full items-center gap-2.5 px-4 py-2.5 text-sm
                                               text-red-600 hover:bg-red-50
                                               dark:text-red-400 dark:hover:bg-red-900/20
                                               transition-colors"
                                        role="menuitem">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75"/>
                                    </svg>
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Flash messages --}}
            <div class="px-4 sm:px-6 lg:px-8 pt-4 space-y-2" aria-live="polite" aria-atomic="true">
                @if(session('success'))
                    <div class="alert-success" role="status">
                        <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert-error" role="alert">
                        <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
            </div>

            {{-- Page content --}}
            <main id="main-content" class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8" tabindex="-1">
                {{ $slot }}
            </main>
        </div>
    </div>

</body>
</html>