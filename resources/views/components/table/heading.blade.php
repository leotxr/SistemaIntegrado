@props([
'sortable' => null,
'direction' => null,
])

<th {{$attributes->merge(['class' => 'px-6 py-4 font-medium text-gray-900 whitespace-nowrap
    dark:text-white'])->only('class')}}
    >
    @unless ($sortable)
    <span class="text-left text-xs leading-4 font-medium text-cool-gray-500 uppercase tracking-wider">
        {{$slot}}
    </span>
    @else
    <button {{$attributes->except('class')}} class="flex items-center space-x-1 text-left text-xs leading-4
        font-medium">
        <span>{{$slot}}</span>

        <span>
            @if($direction === 'asc')
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="gray" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
            </svg>
            @elseif($direction === 'desc')
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="gray" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
            @else
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="gray" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
              </svg>              
            @endif


    </button>
    @endif

</th>