@props([
'actions' => null,
])
<div id="accordion-flush" x-data="{ open: true, toggle() { this.open = ! this.open } }"
     data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
     data-inactive-classes="text-gray-500 dark:text-gray-400">
    <h2 id="accordion-flush-heading-1">
        <div
            class="flex items-center justify-between w-full py-4 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
            <div class="text-start w-full">{{$title}}
                @if($actions)
                    <div class="flex items-center justify-start w-full">
                        {{$actions}}
                    </div>
                @endif
            </div>
            <a type="button" class="block text-lg transition-all cursor-pointer" @click="toggle()"
               :class="open === true ? 'rotate-180' : ''">
                <x-icon name="chevron-up" class="w-6 h-6"></x-icon>
            </a>

        </div>
    </h2>
    <div id="accordion-flush-body-1" class="block" x-show="open" x-transition>
        {{$content}}
    </div>
</div>
