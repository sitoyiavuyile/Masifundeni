{{-- Usage: <x-nav-item :href="route('x')" :active="bool" label="Label">SVG icon</x-nav-item> --}}
@props([
    'href'   => '#',
    'active' => false,
    'label'  => '',
])

<a
    href="{{ $href }}"
    aria-current="{{ $active ? 'page' : 'false' }}"
    class="group relative flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium
           transition-colors duration-150 cursor-pointer
           focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:outline-none
           {{ $active
               ? 'bg-blue-600/20 text-white'
               : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}"
>
    {{-- Active left bar --}}
    @if($active)
        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-0.5 h-5 rounded-r-full bg-blue-500"
              aria-hidden="true"></span>
    @endif

    {{-- Icon slot --}}
    <span class="shrink-0 {{ $active ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }}
                 transition-colors duration-150">
        {{ $slot }}
    </span>

    {{-- Label --}}
    <span class="truncate">{{ $label }}</span>
</a>