<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <div x-data="{
        content: 'Lorem ipsum dolor sit amet'
    }" class="bg-gray-200 border border-gray-900">
                        <alpine-editor x-model="content" data-h1-classes="text-xl">
                            <div data-type="menu">
                                <button type="button" data-command="strong" data-active-class="bg-blue-400"
                                    class="bg-gray-500">
                                    Bold
                                </button>
                                <button type="button" data-command="em" data-active-class="bg-blue-400"
                                    class="bg-gray-500">
                                    Emphasize
                                </button>
                                <button type="button" data-command="code" data-active-class="bg-blue-400"
                                    class="bg-gray-500">
                                    Code
                                </button>
                                <button type="button" data-command="heading" data-level="1"
                                    data-active-class="bg-blue-400" class="bg-gray-500">
                                    H1
                                </button>
                            </div>

                            <div data-type="editor" class="p-2">
                                as
                            </div>
                        </alpine-editor>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>