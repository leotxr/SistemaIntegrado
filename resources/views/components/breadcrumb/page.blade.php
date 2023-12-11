@props(['current'])
@php
    $classes = ($current ?? false)
? 'ms-1 text-sm font-bold text-blue-800 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white'
: 'ms-1 text-sm font-medium text-gray-500 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white'
@endphp
<li>
    <div class="flex items-center space-x-2">
        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <span {{ $attributes->merge(['class' => $classes]) }}>{{$slot}}</span>
    </div>
</li>
