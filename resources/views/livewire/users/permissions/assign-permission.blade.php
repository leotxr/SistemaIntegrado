<div>
    <form wire:submit.prevent="save">
        @csrf
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 content-center p-2 ">
            <div class="col-span-2 sm:col-span-2">
                <x-input-label for="role" class="block text-sm font-medium text-gray-700">Cargo/Setor</x-input-label>
                <x-select id="role" name="role" autocomplete="cargo" wire:model.defer="selected_permission"
                          class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <x-slot name="option">
                        <option >Selecione</option>
                        @foreach($permissions as $permission)
                            <x-select.option value="{{$permission->name}}">{{$permission->name}}</x-select.option>
                            @endforeach
                    </x-slot>
                </x-select>
            </div>
            <div class="col-span-2 sm:col-span-2 flex items-end">
                <x-primary-button type="submit">Salvar</x-primary-button>
            </div>
        </div>
    </form>
</div>
