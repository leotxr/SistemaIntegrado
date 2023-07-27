<div id="accordion-flush" x-data="{open: true}"
    data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
    data-inactive-classes="text-gray-500 dark:text-gray-400">
    <h2 id="accordion-flush-heading-1">
        <button type="button"
            class="flex items-center justify-between w-full py-4 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
            @click="open = ! open">
            <span>{{$title}}</span>
            <x-icon name="chevron-down" class="w-6 h-6 shrink-0"></x-icon>
        </button>
    </h2>
    <div id="accordion-flush-body-1" class="block" x-show="open" x-transition>
        {{$content}}
    </div>
</div>