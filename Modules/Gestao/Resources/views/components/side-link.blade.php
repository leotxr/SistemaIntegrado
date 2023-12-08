@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'text-white inline-flex items-center border-l-4 border-blue-400 leading-5 px-1 pt-2 pb-2 bg-blue-400 bg-opacity-50'
                : 'inline-flex items-center px-1 pt-2 pb-2 border-l-4 border-transparent text-md font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
