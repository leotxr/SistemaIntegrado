<x-table class="text-center">
    <x-slot name="head">
        <x-table.heading>ID</x-table.heading>
        <x-table.heading>Funcionário</x-table.heading>
        <x-table.heading>Quantidade Recebida</x-table.heading>
        <x-table.heading>Quantidade Reportada</x-table.heading>
    </x-slot>
    <x-slot name="body">
        @foreach($countUsers as $user)
            <x-table.row class="text-center hover:bg-gray-50 dark:hover:bg-gray-800">
                <x-table.cell>
                    {{$user['id']}}
                </x-table.cell>
                <x-table.cell>
                    {{$user['nome']}}
                </x-table.cell>
                <x-table.cell>
                    {{$user['recebidas']}}
                </x-table.cell>
                <x-table.cell>
                    {{$user['reportadas']}}
                </x-table.cell>
            </x-table.row>
        @endforeach
    </x-slot>
</x-table>
