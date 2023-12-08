@props(['action'])
@php
$classes = 'inline-flex items-center px-2 py-1 me-2 text-xs font-medium bg-blue-100 rounded dark:bg-blue-900 dark:text-white';
@endphp
<span
    {{ $attributes->merge(['class' => $classes]) }} >
{{$slot}}
<button type="button" wire:click="{{$action}}"
        class="inline-flex items-center p-1 ms-2 text-xs text-blue-400 bg-transparent rounded-sm hover:bg-blue-200 hover:text-blue-900 dark:hover:bg-blue-800 dark:hover:text-blue-300"
        aria-label="Remove">
<svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
</svg>
<span class="sr-only">Remove badge</span>
</button>
</span>