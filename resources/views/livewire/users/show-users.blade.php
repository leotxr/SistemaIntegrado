<div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
    <div class="flex p-4 space-x-4 text-end">
        <div>
            <x-text-input type="text" wire:model='search_user' placeholder="Buscar usuários...">
            </x-text-input>
            </div>
        <a type="button" href="{{url('/users/create')}}">
            <x-primary-button>
                <x-icon name="plus" class="w-5 h-5"></x-icon>
                Novo Usuário
            </x-primary-button>
        </a>
    </div>
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <div class="overflow-x-auto">
            {{$users->links()}}
            <x-table>
                <!-- head -->
                <x-slot name="head">

                    <x-table.heading>ID</x-table.heading>
                    <x-table.heading>Nome</x-table.heading>
                    <x-table.heading>Login</x-table.heading>
                    <x-table.heading>Permissao</x-table.heading>
                    <x-table.heading>Ações</x-table.heading>

                </x-slot>
                <x-slot name="body">
                    @foreach ($users as $user)
                    @php
                    $up = $user->roles->pluck("name")->first();
                    @endphp
                    <x-table.row>
                        <x-table.cell>{{ $user->id }}</x-table.cell>
                        <x-table.cell>{{ $user->name}} {{$user->lastname}}</x-table.cell>
                        <x-table.cell>{{ $user->username }}</x-table.cell>
                        <x-table.cell>{{ $up }}</x-table.cell>
                        <x-table.cell class="flex">
                            <a href="{{ url("users/$user->id/edit") }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                        </x-table.cell>
                    </x-table.row>

                    @endforeach
                </x-slot>

            </x-table>

        </div>
    </div>
</div>