<div x-data="{open:false}">
    <div wire:loading>
        @livewire('gestao::utils.loading-screen')
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
        <div class="col-span-2 sm:col-span-2">
            <x-gestao::dropdown>
                <x-slot name="title">
                    <span class="text-gray-100 dark:text-gray-500">Filtrar datas</span>
                </x-slot>
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
            </x-gestao::dropdown>
        </div>
        <div class="col-span-2 sm:col-span-2">
            <x-gestao::dropdown>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                    <x-slot name="title">
                        <span class="text-gray-100 dark:text-gray-500">Filtros adicionais</span>
                    </x-slot>
                    <x-slot name="content">
                        <div
                            class="col-span-2 sm:col-span-4 border rounded-sm w-full p-2">
                            <x-primary-button class="bg-blue-600" wire:click="$set('modal_medicos', 'true')">
                                <x-icon name="filter" class="w-3 h-3" solid></x-icon>
                                Médicos
                            </x-primary-button>
                            @foreach($medicos_selecionados as $medico)
                                <x-gestao::badge
                                    action="remove(1, `{{$medico}}`)">{{substr($medico, 0, 15)}}</x-gestao::badge>
                            @endforeach
                        </div>
                        <div class="col-span-2 sm:col-span-4 border rounded-sm w-full p-2">
                            <x-primary-button class="bg-blue-600" wire:click="$set('modal_setores', 'true')">
                                <x-icon name="filter" class="w-3 h-3" solid></x-icon>
                                Setores
                            </x-primary-button>
                            @foreach($setores_selecionados as $setor)
                                <x-gestao::badge
                                    action="remove(2, `{{$setor}}`)">{{substr($setor, 0, 15)}}</x-gestao::badge>
                            @endforeach
                        </div>
                    </x-slot>

                </div>
            </x-gestao::dropdown>
        </div>
    </div>

    <!-- Bottom-Right Corner -->
    <div class="fixed bottom-4 right-4">
        <button
            wire:click="search"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-4 px-4 rounded-full shadow-lg hover:rotate-90 transition transform duration-75">
            <x-icon name="refresh" class="h-8 w-8 text-white"></x-icon>
        </button>
    </div>

    <div>
        <x-table>
            <x-slot name="head">
                <x-table.heading>Data Exame</x-table.heading>
                <x-table.heading>Hora Exame</x-table.heading>
                <x-table.heading>Data Entrega</x-table.heading>
                <x-table.heading>Código</x-table.heading>
                <x-table.heading>Nome</x-table.heading>
                <x-table.heading>Exame</x-table.heading>
                <x-table.heading>Médico</x-table.heading>
                <x-table.heading>Setor</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach($db as $exame)
                    <x-table.row>
                        <x-table.cell>
                            {{date('d/m/Y', strtotime($exame->DATA_EXAME))}}
                        </x-table.cell>
                        <x-table.cell>
                            {{gmdate('H:i:s', $exame->HORA_EXAME)}}
                        </x-table.cell>
                        <x-table.cell>
                            {{date('d/m/Y', strtotime($exame->DATA_ENTREGA))}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$exame->PACIENTEID}}
                        </x-table.cell>
                        <x-table.cell>{{$exame->PACIENTENOME}}</x-table.cell>
                        <x-table.cell>{{$exame->EXAME}}</x-table.cell>
                        <x-table.cell>{{$exame->MEDICO}}</x-table.cell>
                        <x-table.cell>{{$exame->SETOR}}</x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
        <div class="pt-4">
                {{$db->links()}}
        </div>
    </div>

    <x-gestao::modal wire:model.defer="modal_medicos" maxWidth="2xl">
        <x-slot name="title">
            Médicos
        </x-slot>
        <x-slot name="content">
            <div class="w-full">
                <x-title>Selecione os médicos:</x-title>
                <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="medicos-null" type="checkbox" value=""
                                   wire:model.defer="medicos_selecionados" name="medicos[]"
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="medicos-null"
                                   class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">SEM
                                MÉDICO VINCULADO</label>
                        </div>
                    </li>
                    @foreach($medicos as $medico)
                        <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input id="medicos-{{$medico['MEDICOID']}}" type="checkbox" value="{{$medico['NOME']}}"
                                       wire:model.defer="medicos_selecionados" name="medicos[]"
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="medicos-{{$medico['MEDICOID']}}"
                                       class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$medico['NOME']}}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div>
                <x-primary-button wire:click="$refresh" x-on:click="$dispatch('close')" type="button">Selecionar
                </x-primary-button>
            </div>
        </x-slot>
    </x-gestao::modal>

    <x-gestao::modal wire:model.defer="modal_setores" maxWidth="2xl">
        <x-slot name="title">
            Setores
        </x-slot>
        <x-slot name="content">
            <div class="w-full">
                <x-title>Selecione os setores:</x-title>
                <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @foreach($setores as $setor)
                        <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input id="setores-{{$setor['SETORID']}}" type="checkbox"
                                       value="{{$setor['DESCRICAO']}}"
                                       wire:model.defer="setores_selecionados" name="setores[]"
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="setores-{{$setor['SETORID']}}"
                                       class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$setor['DESCRICAO']}}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div>
                <x-primary-button wire:click="$refresh" x-on:click="$dispatch('close')" type="button">Selecionar
                </x-primary-button>
            </div>
        </x-slot>
    </x-gestao::modal>
</div>
