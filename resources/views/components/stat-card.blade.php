@props(['label', 'value', 'color' => 'indigo'])

@php
$colors = [
    'indigo' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
    'green'  => 'bg-green-50 text-green-700 border-green-200',
    'yellow' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
    'red'    => 'bg-red-50 text-red-700 border-red-200',
];
$classes = $colors[$color] ?? $colors['indigo'];
@endphp

<div class="rounded-lg border p-5 {{ $classes }}">
    <p class="text-sm font-medium opacity-75">{{ $label }}</p>
    <p class="text-3xl font-bold mt-1">{{ $value }}</p>
</div>