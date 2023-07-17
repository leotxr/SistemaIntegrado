<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-4 text-end">
                    <a type="button" href="{{url('/users/create')}}">
                        <x-primary-button>
                            <x-icon name="plus" class="w-5 h-5"></x-icon>
                            Novo Usuário
                        </x-primary-button>
                    </a>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Login</th>
                                    <th>Permissao</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                @php
                                $up = $user->roles->pluck("name")->first();
                                @endphp
                                <tr>
                                    <th>{{ $user->id }}</th>
                                    <td>{{ $user->name}} {{$user->lastname}}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $up }}</td>
                                    <td class="flex">
                                        <a href="{{ url("users/$user->id/edit") }}"  class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                            {{ $users->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>