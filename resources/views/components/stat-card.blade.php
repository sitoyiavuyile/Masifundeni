{{-- Usage: <x-stat-card label="Students" :value="240" color="blue" icon="users" :change="+12" /> --}}
@props([
    'label'  => '',
    'value'  => 0,
    'color'  => 'blue',
    'change' => null,   // optional: integer, positive = up, negative = down
])

@php
$colors = [
    'blue'   => ['bg-blue-50 dark:bg-blue-900/30',   'text-blue-600 dark:text-blue-400',   'bg-blue-100 dark:bg-blue-800/60'],
    'green'  => ['bg-emerald-50 dark:bg-emerald-900/30', 'text-emerald-600 dark:text-emerald-400', 'bg-emerald-100 dark:bg-emerald-800/60'],
    'yellow' => ['bg-amber-50 dark:bg-amber-900/30',  'text-amber-600 dark:text-amber-400',  'bg-amber-100 dark:bg-amber-800/60'],
    'red'    => ['bg-red-50 dark:bg-red-900/30',      'text-red-600 dark:text-red-400',      'bg-red-100 dark:bg-red-800/60'],
    'purple' => ['bg-purple-50 dark:bg-purple-900/30','text-purple-600 dark:text-purple-400','bg-purple-100 dark:bg-purple-800/60'],
];
[$cardBg, $iconColor, $iconBg] = $colors[$color] ?? $colors['blue'];
@endphp

<div class="card p-5 flex items-start gap-4" role="region" aria-label="{{ $label }} statistic">
    {{-- Icon area --}}
    <div class="shrink-0 flex items-center justify-center w-12 h-12 rounded-xl {{ $iconBg }}">
        <span class="{{ $iconColor }}" aria-hidden="true">
            {{ $slot }}
        </span>
    </div>

    {{-- Text --}}
    <div class="min-w-0 flex-1">
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400 truncate">
            {{ $label }}
        </p>
        <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-slate-100 tabular-nums">
            {{ number_format($value) }}
        </p>

        @if($change !== null)
            <p class="mt-1 flex items-center gap-1 text-xs font-medium
                       {{ $change >= 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }}">
                @if($change >= 0)
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18"/>
                    </svg>
                    <span>+{{ $change }} this month</span>
                @else
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3"/>
                    </svg>
                    <span>{{ $change }} this month</span>
                @endif
            </p>
        @endif
    </div>
</div>