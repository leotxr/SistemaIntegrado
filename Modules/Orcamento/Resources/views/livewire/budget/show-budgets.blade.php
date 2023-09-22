<div>
    <div>
        <div class="grid justify-end text-end">
            <div>
                <x-primary-button wire:click="openModalBudget">
                    <x-icon name="plus" class="w-4 h-4 text-white" /> Nova Solicitação
                </x-primary-button>
            </div>
        </div>
        <x-accordion>
            <x-slot name="title">
                <div class="flex justify-start mx-2 font-bold text-gray-900 dark:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                    </svg>
                    <h1>Filtros<h1>
                </div>
            </x-slot>
            <x-slot name="content">
                <div class="max-w-full">
                    <div class="grid content-center grid-cols-1 gap-2 sm:grid-cols-6 ">
                        <div class="col-span-1 sm:col-span-1 ">
                            <label for="initial_date"
                                class="text-sm font-light text-gray-900 label dark:text-gray-50">Data
                                inicial</label>
                            <input type="date" wire:model='initial_date' id="initial_date"
                                class="border-gray-300 input">
                        </div>
                        <div class="col-span-1 sm:col-span-1 ">
                            <label for="final_date"
                                class="text-sm font-light text-gray-900 label dark:text-gray-50">Data Final</label>
                            <input type="date" wire:model='final_date' id="final_date" class="border-gray-300 input">
                        </div>
                        <div class="col-span-1 sm:col-span-3 sm:mt-4 ">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Status</h3>
                            <ul
                                class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach($statuses as $status)
                                <li
                                    class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <input id="status_{{$status->id}}" type="checkbox" value="{{$status->id}}"
                                            wire:model='selectedStatus'
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="status_{{$status->id}}"
                                            class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$status->name}}</label>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-span-1 sm:col-span-3 ">
                            <label for="search_patient"
                                class="text-sm font-light text-gray-900 label dark:text-gray-50">Buscar Paciente</label>
                            <x-text-input type="text" wire:model='search' id="search_patient" name="search_patient"
                                class="block w-full mt-1 uppercase input"></x-text-input>
                        </div>
                    </div>
                </div>
            </x-slot>
        </x-accordion>
        <div class="mt-4">
            <p>Mostrando orçamentos realizados entre {{date('d/m/Y', strtotime($initial_date))}} e {{date('d/m/Y',
                strtotime($final_date))}}</p>
            {{$orcamentos->links()}}
            <x-table>
                <x-slot name="head">
                    <x-table.heading>
                        Data
                    </x-table.heading>
                    <x-table.heading>
                        Paciente
                    </x-table.heading>
                    <x-table.heading>
                        Telefone
                    </x-table.heading>
                    <x-table.heading>
                        Valor
                    </x-table.heading>
                    <x-table.heading>
                        Status
                    </x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @foreach($orcamentos as $orcamento)
                    @php
                    $status_orcamento = $orcamento->find($orcamento->id)->relStatus;
                    @endphp
                    <x-table.row class="cursor-pointer hover:bg-gray-100"
                        wire:click='openModalDetails({{$orcamento->id}})'>
                        <x-table.cell>
                            {{date('d/m/Y H:i:s', strtotime($orcamento->created_at))}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$orcamento->patient_name}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$orcamento->patient_phone}}
                        </x-table.cell>
                        <x-table.cell>
                            R$ {{$orcamento->total_value}}
                        </x-table.cell>
                        <x-table.cell>
                            <span
                                class="text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded  dark:text-gray-300"
                                style="background-color: {{$status_orcamento->color}}">{{$status_orcamento->name}}</span>
                        </x-table.cell>
                    </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>
            {{$orcamentos->links()}}
        </div>
    </div>

    <x-modal wire:model.defer='modalBudget' maxWidth='5xl'>
        @livewire('orcamento::budget.create-budget-form')
    </x-modal>

    @isset($showing)
    <x-modal wire:model.defer='modalDetails' maxWidth='5xl'>
        @livewire('orcamento::budget.budget-details', ['orcamento' => $showing], key($showing->id))
    </x-modal>
    @endisset
</div>