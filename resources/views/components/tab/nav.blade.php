@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 border-indigo-400'
            : 'inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300';
@endphp

<a  {{ $attributes->merge(['class' => $classes]) }}  href="#">{{$slot}}</a>