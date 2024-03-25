<div>
    <div class="space-y-2">
        <x-table>
            <x-slot name="head">
                <x-table.heading>Cargo</x-table.heading>
                <x-table.heading>Permissões</x-table.heading>
                <x-table.heading>Ação</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach($user->getRoleNames() as $userRole)
                    <x-table.row>
                        <x-table.cell>{{$userRole}}</x-table.cell>
                        <x-table.cell><a class="cursor-pointer grid justify-items-center"
                                         wire:click="showDetails('{{$userRole}}')">
                                <x-icon name="eye" class="w-5 h-5"></x-icon>
                            </a></x-table.cell>
                        <x-table.cell>
                            <a class="cursor-pointer grid justify-items-center"
                               wire:click="revokeRole('{{$userRole}}')">
                                <x-icon name="x" class="w-5 h-5 text-red-600"></x-icon>
                            </a>
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
        <div>
            <x-secondary-button wire:click="showDirectPermissions">Ver permissões diretas</x-secondary-button>
        </div>
    </div>
    <div>
        <x-modal.dialog wire:model.defer="modalDetails">
            <x-slot:title>Permissões vinculadas ao cargo {{$showing_role->name ?? ''}}</x-slot:title>
            <x-slot:content>
                <div>
                    @isset($showing_role)
                        <div>
                            @foreach($role_permissions as $role_permission)
                                <p>{{$role_permission->name}}</p>
                            @endforeach
                        </div>
                    @endisset
                </div>
            </x-slot:content>
            <x-slot:footer>
                <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>
            </x-slot:footer>
        </x-modal.dialog>
    </div>
    <div>
        <x-modal.dialog wire:model.defer="modalPermissions">
            <x-slot:title>Permissões vinculadas diretamente</x-slot:title>
            <x-slot:content>
                <div x-data="{formPermission: false}">
                    <x-table>
                        <x-slot name="head">
                            <x-table.heading>Permissão</x-table.heading>
                            <x-table.heading>Ação</x-table.heading>
                        </x-slot>
                        <x-slot name="body">
                            @foreach($user->getDirectPermissions() as $direct_permission)
                                <x-table.row>
                                    <x-table.cell>{{$direct_permission->name}}</x-table.cell>
                                    <x-table.cell>
                                        <a class="cursor-pointer grid justify-items-center"
                                           wire:click="revokePermission('{{$direct_permission->name}}')">
                                            <x-icon name="x" class="w-5 h-5 text-red-600"></x-icon>
                                        </a>
                                    </x-table.cell>
                                </x-table.row>
                            @endforeach
                        </x-slot>
                    </x-table>
                    <div class="w-full grid justify-items-end p-2">
                        <a type="button" class="inline-flex items-center cursor-pointer"
                           x-on:click="formPermission = ! formPermission">
                            <div :class="formPermission ? 'rotate-45 transition transform duration-300 text-red-600' : 'transition transform duration-300 text-green-600'">
                                <x-icon name="plus" class="w-6 h-6 "></x-icon>
                            </div>
                            <span> Atribuir nova permissão</span> </a>
                    </div>

                    <div x-show="formPermission">
                        @livewire('users.permissions.assign-permission', ['user' => $user])
                    </div>
                </div>
            </x-slot:content>
            <x-slot:footer>
                <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>
            </x-slot:footer>
        </x-modal.dialog>
    </div>
</div>
