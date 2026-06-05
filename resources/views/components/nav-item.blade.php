@props(['href', 'active' => false])

<a href="{{ $href }}"
   class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition
          {{ $active
              ? 'bg-indigo-600 text-white'
              : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
    {{ $slot }}
</a>