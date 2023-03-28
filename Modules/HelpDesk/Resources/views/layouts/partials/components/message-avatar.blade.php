<div class="flex items-center space-x-4">
    @isset($solicitante->profile_img)
    <img class="w-10 h-10 rounded-full" src="{{URL::asset($solicitante->profile_img)}}" alt="">
    @endisset
    @empty($solicitante->profile_img)
    <div class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
        <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
            </path>
        </svg>
    </div>
    @endempty
    <div class="font-medium dark:text-white">
        <div>{{$solicitante->name}}</div>
        <div class="text-sm text-gray-500 dark:text-gray-400">Solicitante</div>
    </div>
</div>