@props(['image', 'user', 'time'])
<div class="flex items-start gap-2.5 border-b border-b-gray-300 dark:border-b-gray-700">
    <img class="w-8 h-8 rounded-full" src="{{$image}}" alt="">
    <div class="flex flex-col w-full max-w-full leading-1.5">
        <div class="flex items-center space-x-2 rtl:space-x-reverse">
            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{$user}}</span>
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{$time}}</span>
        </div>
        <div class="text-sm font-normal py-2 text-gray-900 dark:text-white">
            {{$slot}}
        </div>
    </div>
</div>