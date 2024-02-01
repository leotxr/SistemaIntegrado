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

                @can(['editar ncs'])
                    <div class="sm:col-span-4 col-span-2 mt-4">
                        <x-input-label for="date_2">Criadas por:</x-input-label>
                        <x-secondary-button
                            wire:click="openModal('created')">{{count($selected_users) . ' Usuários selecionados'}} </x-secondary-button>
                    </div>
                    <div class="sm:col-span-4 col-span-2 mt-4">
                        <x-input-label for="date_2">Recebidas por:</x-input-label>
                        <x-secondary-button
                            wire:click="openModal('target')">{{count($selected_target_users) . ' Usuários selecionados'}} </x-secondary-button>
                    </div>
                @endcan

            </div>
            <div class="grid justify-end p-4 bottom-0">
                <x-primary-button type="submit" class="rounded-none" wire:loading.attr="disabled">Filtrar
                </x-primary-button>
            </div>
        </form>
    </div>

    {{-- MODAL USUARIOS
    <x-nc::modal wire:model.defer="modal_filters">
        <x-slot:title>
            Usuários
        </x-slot:title>
        <x-slot:content>
            <div class="w-full">
                <x-title>Selecione os usuários:</x-title>
                <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full">
                        <div class="flex items-center ps-3">
                            <x-text-input type="checkbox" id="select_all" name="select_all"
                                          wire:model="selectAllUsers" class="w-4 h-4"></x-text-input>
                            <x-input-label for="select_all"
                                           class="py-3 ms-2">Selecionar todos
                            </x-input-label>
                        </div>
                    </li>
                    @foreach($users as $user)
                        <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input id="users-{{$user->id}}" type="checkbox"
                                       value="{{$user->id}}"
                                       wire:model="selected_users" name="users[]"
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="users-{{$user->id}}"
                                       class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$user->name . ' ' . $user->lastname}}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </x-slot:content>
        <x-slot:footer>
            <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>
        </x-slot:footer>
    </x-nc::modal>
    --}}

    {{-- MODAL SETORES --}}
    <x-nc::modal wire:model.defer="modal_filters">
        <x-slot:title>
            Usuários
        </x-slot:title>
        <x-slot:content>
            <div class="w-full">
                <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full">
                        <div class="flex items-center ps-3">
                            <x-text-input type="checkbox" id="select_all" name="select_all"
                                          wire:model="selectAllUsers" class="w-4 h-4"></x-text-input>
                            <x-input-label for="select_all"
                                           class="py-3 ms-2">Selecionar todos
                            </x-input-label>
                        </div>
                    </li>
                </ul>
                @foreach($groups as $group)
                    <div class="mt-2">
                        <x-title>Setor {{$group->name}}:</x-title>
                        <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach($group->users as $user)
                                <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                    <div class="flex items-center ps-3">
                                        @if($user_type == 'created')
                                            <input id="users-{{$user->id}}" type="checkbox"
                                                   value="{{$user->id}}"
                                                   wire:model="selected_users" name="users[]"
                                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        @else
                                            <input id="users-{{$user->id}}" type="checkbox"
                                                   value="{{$user->id}}"
                                                   wire:model="selected_target_users" name="users[]"
                                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        @endif
                                        <label for="users-{{$user->id}}"
                                               class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$user->name . ' ' . $user->lastname}}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </x-slot:content>
        <x-slot:footer>
            <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>
        </x-slot:footer>
    </x-nc::modal>

</div>
