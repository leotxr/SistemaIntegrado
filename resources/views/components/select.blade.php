@props(['disabled' => false])
    <select
    {{ $disabled ? 'disabled' : '' }}
        {{ $attributes->merge(['class' => 'mt-1 block font-bold rounded-md border border-gray-300 bg-white dark:bg-gray-900 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm'])}}>
        {{$option}}
    </select>
