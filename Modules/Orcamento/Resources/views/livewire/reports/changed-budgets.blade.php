<div class="p-6 text-gray-900 bg-white">
    <div class="dark:text-gray-100 dark:bg-gray-800">
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
                                class="text-sm font-light text-gray-900 label dark:text-gray-50">Data
                                Final</label>
                            <input type="date" wire:model='final_date' id="final_date" class="border-gray-300 input">
                        </div>
                        
                        <div class="col-span-1 sm:col-span-3">
                            <div class="sm:mt-10">
                                <x-secondary-button id="excel" type="button" wire:click='export' >
                                    <x-icon name="document" class="w-6 h-6"></x-icon>
                                    Exportar
                                </x-secondary-button>
                            </div>
                        </div>


                        <div class="col-span-1 sm:col-span-3 ">
                            <label for="search_patient"
                                class="text-sm font-light text-gray-900 label dark:text-gray-50">Buscar
                                Paciente</label>
                            <x-text-input type="text" wire:model='search' id="search_patient" name="search_patient"
                                class="block w-full mt-1 uppercase input">
                            </x-text-input>
                        </div>

                    </div>
                </div>
            </x-slot>

        </x-accordion>
    </div>
    <div class="mt-4">

        @include('orcamento::reports.tables.table-changed-budgets')
    </div>
</div>