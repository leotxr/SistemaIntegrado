<div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
    <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
        <div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Definir Permissões aos cargos') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Crie permissões para determinar o que cada usuário pode fazer. (Exemplo: autorizar pedido,
                solicitar
                autorizacao, abrir chamado)') }}
            </p>
        </div>

        <form wire:submit.prevent='save'>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="roles" class="block text-sm font-medium text-gray-700">Cargo</label>
                    <select id="roles" name="role_id" autocomplete="Cargos" wire:model='selectedRole'
                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">

                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="permissions" class="block text-sm font-medium text-gray-700">Permissão</label>
                    <select id="permissions" name="permission_id" autocomplete="Permissoes"
                        wire:model='selectedPermission'
                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                        <option>
                            @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>



                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                    @if (session('status') === 'role-stored')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Registro salvo com sucesso.') }}</p>
                    @endif
                </div>
            </div>
        </form>

    </div>
    <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
        <div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Permissões concedidas à
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Veja e revogue permissões') }}
            </p>
        </div>
        <div>

            <x-table>
                <x-slot name='head'>
                    <x-table.heading>
                        Revogar
                    </x-table.heading>
                    <x-table.heading>
                        Permissão
                    </x-table.heading>
                </x-slot>
                <x-slot name='body'>
                    @foreach($rolePermissions->permissions as $permission)
                    <x-table.row>
                        <x-table.cell>
                            <button type="button" wire:click='revoke({{$permission->id}})' class="font-semibold text-red-600">Revogar</button>
                        </x-table.cell>
                        <x-table.cell>
                            {{$permission->name}}
                        </x-table.cell>
                    </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>


        </div>
    </div>
</div>