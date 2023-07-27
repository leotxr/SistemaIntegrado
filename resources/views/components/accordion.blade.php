<div id="accordion-flush" x-data="{open: true}"
    data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
    data-inactive-classes="text-gray-500 dark:text-gray-400">
    <h2 id="accordion-flush-heading-1">
        <button type="button"
            class="flex items-center justify-between w-full py-4 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
            @click="open = ! open">
            <span>{{$title}}</span>
            <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </h2>
    <div id="accordion-flush-body-1" class="block" x-show="open" x-transition>
       {{$content}}
    </div>
</div>