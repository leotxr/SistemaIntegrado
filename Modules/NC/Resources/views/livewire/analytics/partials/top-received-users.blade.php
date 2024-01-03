<div>
<div class="w-full px-4 py-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <x-title>Usuários que mais receberam</x-title>
    <span class="text-xs font-light text-gray-500">Exibe os 5 usuários que mais receberam Não Conformidades no período.</span>
    <x-table>
        <x-slot name="head">
            <x-table.heading>Usuário</x-table.heading>
            <x-table.heading>Quantidade</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @foreach($user_count->sortByDesc('value')->take(5) as $user)
                <x-table.row>
                    <x-table.cell class="text-center">
                        {{$user['name']}}
                    </x-table.cell>
                    <x-table.cell class="text-center">
                        {{$user['value']}}
                    </x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table>
</div>

</div>
