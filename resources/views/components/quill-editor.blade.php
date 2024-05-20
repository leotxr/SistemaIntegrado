@props(['image', 'title', 'description'])
<div class="flex items-center gap-4">
    @isset($image)
    <img class="w-10 h-10 rounded-full" src="{{$image}}" alt="">
    @endisset
    <div class="font-regular dark:text-gray-50">
        <div>{{$title}}</div>
        <div class="text-sm text-gray-500 dark:text-gray-400">{{$description}}</div>
    </div>
</div>