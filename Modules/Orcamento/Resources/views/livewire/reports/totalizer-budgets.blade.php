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
                        <div class="col-span-1 sm:col-span-1 sm:mt-1">
                            <label for="filter"
                                class="text-sm font-light text-gray-900 label dark:text-gray-50">Filtros</label>
                            <x-primary-button id="filter" wire:click="$set('modalFilters', true)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                                </svg>
                                <span>Filtros<span>
                            </x-primary-button>
                        </div>

                        <div class="col-span-1 sm:col-span-1">
                            <div class="sm:mt-10">
                                <x-secondary-button id="excel" type="button" wire:click='export'>
                                    <x-icon name="document" class="w-6 h-6"></x-icon>
                                    Exportar
                                </x-secondary-button>
                            </div>
                        </div>
                    </div>
                    {{--
                    @foreach($users as $user)
                    @php
                    var_dump($user->budgets->whereBetween('budget_date', [$initial_date, $final_date])->count());
                    @endphp
                    @endforeach
                    --}}
                </div>
            </x-slot>

        </x-accordion>
    </div>
    <div class="mt-4">
        @php
        var_dump($users->where('created_at', '!=', 'updated_at'))
        @endphp
        @include('orcamento::reports.tables.table-totalizer-budgets')
    </div>

    {{--MODAL
    <x-modal.dialog wire:model.defer="modalFilters">
        <x-slot name="title">
            Filtros de pesquisa
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="p-4 border-2">
                    <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Selecionar Usuários</h3>
                    @foreach($users as $user)
                    @if($user->budgets->count() > 0)
                    <ul
                        class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input wire:model='selectedUsers' id="user-{{$user->id}}" name="selectedUsers[]"
                                    type="checkbox" value="{{$user->id}}"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="user-{{$user->id}}"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$user->name}}</label>
                            </div>
                        </li>
                    </ul>
                    @endif
                    @endforeach
                </div>
                
                <div class="p-4 border-2">
                    <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Selecionar Status</h3>
                    @foreach($statuses as $status)
                    <ul
                        class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input wire:model='selectedStatuses' id="status-{{$status->id}}" type="checkbox"
                                    name="selectedStatuses[]" value="{{$status->id}}"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="status-{{$status->id}}"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$status->name}}</label>
                            </div>
                        </li>
                    </ul>
                    @endforeach
                </div>
                
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-primary-button x-on:click="$dispatch('close')">Selecionar</x-primary-button>
        </x-slot>

    </x-modal.dialog>
    --}}
</div>