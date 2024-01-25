<div>
    <div class="max-w-sm">
        <x-input-label for="search_user">Responsáveis pela Não Conformidade</x-input-label>
        <x-text-input type="text" wire:model="search_user" id="search_user" class="w-full"
                      placeholder="Pesquisar"></x-text-input>
        <x-input-error class="mt-2"
                       :messages="$errors->get('selectedUsers')"/>
        @if(strlen($search_user) > 2)
            <div class="bg-white dark:bg-gray-800 shadow-md p-2 w-full rounded-md z-10 relative">
                <ul>
                    @foreach($target_users as $target)
                        <li class="space-x-2 p-2 border-b dark:border-gray-700 dark:hover:bg-gray-700 hover:bg-gray-100">
                            <x-input-label for="target_user_{{$target->id}}">
                                <x-text-input type="checkbox" name="target_users[]"
                                              wire:click="attachUser({{$target->id}})"
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
