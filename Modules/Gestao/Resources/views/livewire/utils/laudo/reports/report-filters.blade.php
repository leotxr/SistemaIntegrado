<div>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
        <div class="col-span-2 sm:col-span-2">
            <x-gestao::dropdown>
                <x-slot name="title">
                    <span class="text-gray-100 dark:text-gray-500">Filtrar datas</span>
                </x-slot>
                <x-slot name="content">
                    <div class="inline-flex space-x-2">
                        <div class="inline-flex space-x-2">
                            <x-text-input type="radio" class="rounded-full" name="date_by" id="date_by_exam"
                                          wire:model="date_by" value="FATURA.DATA"/>
                            <x-input-label for="date_by_exam">Data do exame</x-input-label>
                        </div>
                        <div class="inline-flex space-x-2">
                            <x-text-input type="radio" class="rounded-full" name="date_by" id="date_by_delivery"
                                          wire:model="date_by" value="FATURA.ENTREGADATA"/>
                            <x-input-label for="date_by_delivery">Data de entrega</x-input-label>
                        </div>
                    </div>
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
                        @isset($by_doctor)
                            <div class="col-span-2 sm:col-span-4 border rounded-sm w-full p-2">
                                <div class="inline-flex space-x-2">
                                    <div class="inline-flex space-x-2">
                                        <x-text-input type="radio" class="rounded-full" name="by_doctor" id="by_doctor_ass"
                                                      wire:model="by_doctor" value="FATURA.MEDREAID"/>
                                        <x-input-label for="by_doctor_ass">Exames sem Assinante</x-input-label>
                                    </div>
                                    <div class="inline-flex space-x-2">
                                        <x-text-input type="radio" class="rounded-full" name="by_doctor"
                                                      id="by_doctor_rev"
                                                      wire:model="by_doctor" value="FATURA.MEDREA2ID"/>
                                        <x-input-label for="by_doctor_rev">Exames sem Revisor</x-input-label>
                                    </div>
                                </div>
                            </div>
                        @endisset
                        @isset($medicos_selecionados)
                            <div
                                class="col-span-2 sm:col-span-4 border rounded-sm w-full p-2 overflow-x-auto">
                                <x-primary-button class="bg-blue-600" wire:click="$set('modal_medicos', 'true')">
                                    <x-icon name="filter" class="w-3 h-3" solid></x-icon>
                                    Médicos
                                </x-primary-button>
                                @foreach($medicos_selecionados as $medico)
                                    <x-gestao::badge
                                        action="remove(1, `{{$medico}}`)">{{substr($medico, 0, 15)}}</x-gestao::badge>
                                @endforeach
                            </div>
                        @endisset
                        @isset($setores_selecionados)
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
                        @endisset
                    </x-slot>

                </div>
            </x-gestao::dropdown>
        </div>

    </div>
    @isset($medicos)
        <x-gestao::modal wire:model.defer="modal_medicos" maxWidth="2xl">
            <x-slot name="title">
                Médicos
            </x-slot>
            <x-slot name="content">
                <div class="w-full">
                    <x-title>Selecione os médicos:</x-title>
                    <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full">
                            <div class="flex items-center ps-3">
                                <x-text-input type="checkbox" id="select_doctors" name="select_doctors"
                                              wire:model="selectAllDoctors" class="w-4 h-4"></x-text-input>
                                <x-input-label for="select_doctors"
                                               class="py-3 ms-2">Selecionar todos
                                </x-input-label>
                            </div>
                        </li>
                        @foreach($medicos as $medico)
                            <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                <div class="flex items-center ps-3">
                                    <x-text-input id="medicos-{{$medico['MEDICOID']}}" type="checkbox"
                                                  value="{{$medico['NOME']}}"
                                                  wire:model.defer="medicos_selecionados" name="medicos[]"
                                                  class="w-4 h-4"/>
                                    <x-input-label for="medicos-{{$medico['MEDICOID']}}"
                                                   class="py-3 ms-2">{{$medico['NOME']}}</x-input-label>
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
    @endisset

    @isset($setores)
        <x-gestao::modal wire:model.defer="modal_setores" maxWidth="2xl">
            <x-slot name="title">
                Setores
            </x-slot>
            <x-slot name="content">
                <div class="w-full">
                    <x-title>Selecione os setores:</x-title>
                    <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full">
                            <div class="flex items-center ps-3">
                                <x-text-input type="checkbox" id="select_sectors" name="select_sectors"
                                              wire:model="selectAllSectors" class="w-4 h-4"></x-text-input>
                                <x-input-label for="select_sectors"
                                               class="py-3 ms-2">Selecionar todos
                                </x-input-label>
                            </div>
                        </li>
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
    @endisset
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
</div>
