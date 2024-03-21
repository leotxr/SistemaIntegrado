@props(['height'])
@php
    $height = [
        'xs' => 'h-16',
        'sm' => 'h-32',
        'md' => 'h-64',
        'lg' => 'h-96'
    ][$height ?? 'lg'];
@endphp
<div>
    <div class="px-4 py-6 bg-white rounded-lg shadow-md dark:bg-gray-800 {{$height}} overflow-auto">
        <div>
            <x-title>{{$title}}</x-title>
            <span class="text-xs font-light text-gray-500 dark:text-gray-200">{{$description}}</span>
        </div>
        <div class="px-2 max-{{$height}}">
            {{$content}}
        </div>
    </div>
</div>
