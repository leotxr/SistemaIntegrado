<form wire:submit.prevent="save">
    <x-nc::modal wire:model.defer="open" maxWidth="3xl" class="h-screen overflow-hidden">
        <x-slot:title>
            <x-title class="text-white">Cadastrar</x-title>
        </x-slot:title>
        <x-slot:content>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="col-span-2 sm:col-span-1">
                    <x-input-label for="nc_date">Data da ocorrência</x-input-label>
                    <x-text-input type="date" name="nc_date" id="nc_date"
                                  wire:model.defer="nc.n_c_date"></x-text-input>
                    <x-input-error class="mt-2" :messages="$errors->get('nc.n_c_date')"/>
                </div>
                <div class="col-span-2 sm:col-span-3">
                    <div class="max-w-sm">
                        <x-input-label for="search_user">Responsáveis pela Não Conformidade</x-input-label>
                        <x-text-input type="text" wire:model="search_user" id="search_user" class="w-full"
                                      placeholder="Pesquisar"></x-text-input>
                        <x-input-error class="mt-2"
                                       :messages="$errors->get('selectedUsers')"/>
                        <div class="mt-2">
                            @foreach($selectedUsers as $selected_user)
                                <x-nc::badge
                                    action="removeUser({{$selected_user}})">{{App\Models\User::find($selected_user)->name}}</x-nc::badge>
                            @endforeach
                        </div>
                        @if(strlen($search_user) > 2)
                            <div class="bg-white dark:bg-gray-800 shadow-md p-2 w-full rounded-md z-10 relative">
                                <ul>
                                    @foreach($target_users as $target)
                                        <li class="space-x-2 p-2 border-b dark:border-gray-700 dark:hover:bg-gray-700 hover:bg-gray-100">
                                            <x-input-label for="target_user_{{$target->id}}">
                                                <x-text-input type="checkbox" name="target_users[]"
                                                              wire:model="selectedUsers"
                                                              id="target_user_{{$target->id}}"
                                                              value="{{$target->id}}"/>
                                                {{$target->name}} {{$target->lastname}}</x-input-label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('nc.n_c_target_user_id')"/>
                </div>
                <div class="col-span-2 sm:col-span-4 mt-4">
                    <x-input-label for="nc_description">Descrição</x-input-label>
                    <x-text-area name="nc_description" id="nc_description" wire:model.defer="nc.description"
                                 rows="5"></x-text-area>
                    <x-input-error class="mt-2" :messages="$errors->get('nc.description')"/>
                </div>

                <div class="col-span-2 sm:col-span-2 mt-4">
                    <x-input-label for="classification">Classificação</x-input-label>
                    <x-select class="w-full" name="classification" id="classification"
                              wire:model="nc.n_c_classification_id">
                        <x-slot name="option">
                            <x-select.option
                                value="1">Selecione
                            </x-select.option>
                            @foreach($classifications as $classification)
                                <x-select.option
                                    value="{{$classification->id}}">{{$classification->name}}</x-select.option>
                            @endforeach
                        </x-slot>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('nc.n_c_classification_id')"/>
                </div>
            </div>
        </x-slot:content>
        <x-slot:footer>
            <div class="space-x-2">
                <x-secondary-button x-on:click="$dispatch('close')">Cancelar</x-secondary-button>
                <x-primary-button type="submit">Salvar</x-primary-button>
            </div>
        </x-slot:footer>
    </x-nc::modal>
</form>
