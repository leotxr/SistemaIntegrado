@props(['height', 'width', 'colspan'])
@php
    $height = [
        'xs' => 'sm:h-16 h-16',
        'sm' => 'sm:h-32 h-32',
        'md' => 'sm:h-64 h-64',
        'lg' => 'sm:h-86 h-86',
        'xl' => 'sm:h-96 h-96',
        'full' =>'sm:h-full h-full'
    ][$height ?? 'lg'];
    $width = [
        'xs' => 'sm:w-16 w-16',
        'sm' => 'sm:w-32 w-32',
        'md' => 'sm:w-64 w-64',
        'lg' => 'sm:w-86 w-86',
        'xl' => 'sm:w-96 w-96',
        'full' => 'sm:w-full w-full'
        ][$width ?? 'lg'];
$colspan = $colspan ?? '';
$rowspan = $rowspan ?? '';
@endphp
<div class="{{$colspan}} {{$rowspan}}">
    <div>
        @isset($title)
            <x-title class="font-semibold text-xl">{{$title}}</x-title>
        @endisset
        @isset($description)
            <span class="text-xs font-light text-gray-500 dark:text-gray-200">{{$description}}</span>
        @endisset
    </div>
    <div {{$attributes->merge(['class' => " bg-white rounded-lg shadow-md dark:bg-gray-800 overflow-auto max-w-full max-h-full $height $width"])}}>
        <div class="max-w-full max-h-full p-2">
            {{$content}}
        </div>
    </div>
</div>
