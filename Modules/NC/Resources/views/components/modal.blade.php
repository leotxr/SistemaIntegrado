@props(['id', 'maxWidth'])

@php
    $id = $id ?? md5($attributes->wire('model'));

    $maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
    '3xl' => 'sm:max-w-3xl',
    '5xl' => 'sm:max-w-5xl',

    ][$maxWidth ?? '2xl'];
@endphp

<div x-data="{ show: @entangle($attributes->wire('model')).defer }" x-on:close.stop="show = false"
     x-on:keydown.escape.window="show = false" x-show="show" id="{{ $id }}"
     class="fixed inset-0 z-50 px-4 py-6 overflow-y-auto sm:px-0" style="display: none;">
    <div x-show="show" class="fixed inset-0 transition-all transform" x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        <div class="relative grid justify-end p-8 text-end">
            {{--
            <button type="button" x-on:click="$dispatch('close')">
                <x-icon name="x" class="w-8 h-8 text-white"></x-icon>
            </button>
            --}}
        </div>
    </div>

    <div x-show="show"
         class="mb-6 bg-white dark:bg-gray-900 overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
         x-trap.inert.noscroll="show" x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        <div class="text-lg font-medium text-gray-50 dark:text-gray-100 bg-blue-800 shadow-md p-2 flex w-full">
            {{ $title }}
            <div class="grid justify-end w-full">
                <button type="button" class="active:scale-75" x-on:click="$dispatch('close')">
                    <x-icon name="x" class="w-6 h-6 text-white"></x-icon>
                </button>
            </div>
        </div>

        <div class="mt-4 overflow-y-auto text-sm text-gray-600 max-h-96 dark:text-gray-400 p-2">
            {{$content}}
        </div>

        <div class="flex flex-row justify-end px-6 py-4 text-right bg-gray-100 dark:bg-gray-800 p-2">
            {{$footer}}
        </div>

    </div>
</div>
