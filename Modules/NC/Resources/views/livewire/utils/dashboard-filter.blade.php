<div>
    {{-- BOTAO DE AÇÃO DO FILTRO --}}
    <div class="w-full flex justify-end p-2">
        <x-secondary-button x-on:click="openFilter = !openFilter" class="text-gray-500 dark:text-gray-100">
            <x-icon name="filter" class="w-4 h-4 text-gray-500 dark:text-gray-100"></x-icon>
            Filtrar
        </x-secondary-button>
    </div>

    {{-- FILTRO LATERAL --}}
    <div x-show="openFilter"
         class="z-50 h-screen fixed transform transition duration-300 shadow-md p-4 left-0 top-0 bg-white dark:bg-gray-800 sm:w-64 overflow-hidden">
        <div class="flex justify-start pb-4 border-b">
            <a class="cursor-pointer ring-offset-1 p-2" x-on:click="openFilter = false">
                <x-icon name="x" class="w-5 h-5 text-gray-500 dark:text-gray-100"></x-icon>
            </a>

        </div>
        <form wire:submit.prevent="refreshChildren">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <div class="sm:col-span-4 col-span-2 mt-4">
                    <x-input-label for="date_1">Data Inicial</x-input-label>
                    <x-text-input type="date" name="date_1" id="date_1" wire:model.defer="start_date"
                                  class="w-full rounded-none"></x-text-input>
                </div>
                <div class="sm:col-span-4 col-span-2 mt-4">
                    <x-input-label for="date_2">Data Final</x-input-label>
                    <x-text-input type="date" name="date_2" id="date_2" wire:model.defer="end_date"
                                  class="w-full rounded-none"></x-text-input>
                </div>
            </div>
            <div class="grid justify-end p-4 bottom-0">
                <x-secondary-button type="submit" class="rounded-none">Filtrar</x-secondary-button>
            </div>
        </form>
    </div>
</div>
