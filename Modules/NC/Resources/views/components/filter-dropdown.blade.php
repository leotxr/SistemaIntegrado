<div id="accordion-flush" class="rounded-sm border border-gray-300 dark:border-gray-700" x-data="{open: true}">
    <h2 id="accordion-flush-heading-1">
        <div
            class="flex items-center justify-between w-full font-medium text-left bg-gray-800 p-2 dark:bg-gray-800 dark:text-gray-50 ">
            <div class="text-start text-gray-100 dark:text-gray-50">{{$title}}</div>
            <a type="button" class="block text-lg transition-all cursor-pointer" @click="open = ! open"
               :class="open === true ? 'rotate-180' : ''">
                <x-icon name="chevron-up" class="w-6 h-6 text-white "></x-icon>
            </a>

        </div>
    </h2>
    <div id="accordion-flush-body-1" class="block p-2 text-gray-700 dark:text-gray-100" x-show="open" x-transition>
        {{$content}}
    </div>
</div>
