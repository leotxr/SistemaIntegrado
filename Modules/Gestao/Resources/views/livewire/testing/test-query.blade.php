<div x-data="{ isOpen: false }">
    <div wire:loading>
        @livewire('gestao::utils.loading-screen')
    </div>

    <div x-show="isOpen"
         class="z-50 h-screen absolute transform transition duration-300 shadow-md p-4 right-0 top-0 bg-white dark:bg-gray-800 shadow-md sm:w-64">
        <div class="grid justify-start pb-4">
            <a class="cursor-pointer ring-offset-1 p-2" x-on:click="isOpen = false">
                <x-icon name="x" class="w-5 h-5 text-gray-500 dark:text-gray-100"></x-icon>
            </a>
        </div>
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
            <x-secondary-button type="button" class="rounded-none">Filtrar</x-secondary-button>
        </div>
    </div>
    <div class="">
        <div class="grid justify-end text-end p-2">
            <div x-data="{filters: false}">
                <x-secondary-button class="rounded-none"
                                    x-on:click="isOpen = true">
                    <x-icon name="filter" class="w-5 h-5 text-gray-500 dark:bg-gray-100"></x-icon>
                    filtros
                </x-secondary-button>

            </div>
        </div>

        <x-title class="text-4xl pb-4">Exames sem laudar</x-title>
        <x-table>
            <x-slot name="head">
                <x-table.heading>MÉDICO</x-table.heading>
                @foreach($setores as $setor)
                    <x-table.heading>{{substr($setor, 0, 6)}}</x-table.heading>
                @endforeach
                <x-table.heading>TOTAL</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach($medicos as $medico)
                    <x-table.row class="text-center">
                        <x-table.cell
                            class="border-r">{{$medico === "" ? 'SEM MÉDICO ASSINANTE' : $medico}}</x-table.cell>
                        @foreach($setores as $setor)
                            <x-table.cell
                                class="border-r">{{$db->where("MEDICO", $medico)->where('NOMESETOR', $setor)->count()}}</x-table.cell>
                        @endforeach
                        <x-table.cell class="border-r">{{$db->where('MEDICO', $medico)->count()}}</x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    </div>

</div>
