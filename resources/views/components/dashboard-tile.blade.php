@props(['value'])
<div class="flex items-center p-4 bg-white dark:bg-gray-800 rounded shadow-md">
    @isset($icon)
        {{$icon}}
    @endisset
    <!--

        <div class="flex flex-shrink-0 items-center justify-center bg-green-200 h-16 w-16 rounded">
            <x-icon name="arrow-up" class="w-6 h-6 text-green-700"></x-icon>

-->
    <div class="flex-grow flex flex-col ml-4">
        @isset($value)
            <span class="text-xl font-bold text-gray-900 dark:text-gray-50">{{$value}}</span>
        @endisset
        <div class="flex items-center justify-between">
            <span class="text-gray-500 dark:text-gray-200">{{$description}}</span>
            @isset($statistic)
                <span class="text-gray-500 dark:text-gray-200 text-sm font-semibold ml-2">{{$statistic}}</span>
            @endisset
        </div>
    </div>
</div>