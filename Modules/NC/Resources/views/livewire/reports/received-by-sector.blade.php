<div class="p-2">
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
        <div class="col-span-2 sm:col-span-2">
            <x-nc::filter-dropdown>
                <x-slot:title>Filtrar data</x-slot:title>
                <x-slot name="content">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div class="col-span-2 sm:col-span-2 mt-4">
                            <x-input-label for="start_date">Data inicial</x-input-label>
                            <x-text-input type="date" id="start_date" class="w-full" wire:model.defer="start_date"
                                          name="start_date"></x-text-input>
                        </div>
                        <div class="col-span-2 sm:col-span-2 mt-4">
                            <x-input-label for="end_date">Data final</x-input-label>
                            <x-text-input type="date" id="end_date" class="w-full" wire:model.defer="end_date"
                                          name="end_date"></x-text-input>
                        </div>
                    </div>
                </x-slot>
            </x-nc::filter-dropdown>
        </div>
        <div class="col-span-2 sm:col-span-2">
            <x-nc::filter-dropdown>
                <x-slot:title>Filtrar setor</x-slot:title>
                <x-slot name="content">
                    <div
                        class="col-span-2 sm:col-span-4 border border-gray-300 dark:border-gray-700 rounded-sm w-full p-2 overflow-x-auto">
                        <x-primary-button class="bg-blue-600" wire:click="$set('modalSectors', 'true')">
                            <x-icon name="filter" class="w-3 h-3" solid></x-icon>
                            Setores
                        </x-primary-button>
                        @if($group)
                            <x-badge>{{$group->name}}</x-badge>
                        @endif
                    </div>
                </x-slot>
            </x-nc::filter-dropdown>
        </div>
    </div>
    <div>
        @isset($ncs)
            @include('nc::user.utils.dashboard-table')
        @endisset
    </div>
    <x-nc::modal wire:model.defer="modalSectors">
        <x-slot:title>Setores</x-slot:title>
        <x-slot:content>
            <div class="w-full">
                <x-title>Selecione um setor:</x-title>
                <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @foreach($groups as $sec)
                        <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <x-text-input id="sector-{{$sec->id}}" type="radio" wire:model="selectedSector"
                                              value="{{$sec->id}}"
                                              name="sectors[]"
                                              class="w-4 h-4"/>
                                <x-input-label for="sector-{{$sec->id}}"
                                               class="py-3 ms-2">{{$sec->name}}</x-input-label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

        </x-slot:content>
        <x-slot:footer>
            <div class="space-x-2">
                <x-secondary-button x-on:click="$dispatch('close')">Cancelar</x-secondary-button>
                <x-primary-button type="submit" wire:click="setSector">Selecionar</x-primary-button>
            </div>
        </x-slot:footer>
    </x-nc::modal>

    <!-- Bottom-Right Corner -->
    <div class="fixed bottom-4 right-4 ">

        <button
            wire:click="export"
            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-2 rounded-full shadow-lg hover:scale-115 transition transform duration-75">
            <x-icon name="table" class="h-6 w-6 text-white"></x-icon>
        </button>


        <button
            wire:click="search"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-4 px-4 rounded-full shadow-lg hover:rotate-90 transition transform duration-75">
            <x-icon name="refresh" class="h-8 w-8 text-white"></x-icon>
        </button>
    </div>

    @livewire('nc::forms.edit')
</div>
