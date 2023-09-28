<x-table>
    <x-slot name="head">
        <x-table.heading>
            Usuário
        </x-table.heading>
        @foreach($statuses as $status)
        <x-table.heading>
            {{$status->name}}
        </x-table.heading>
        @endforeach
        <x-table.heading>
            Total
        </x-table.heading>
    </x-slot>
    <x-slot name="body">
        @foreach($users as $user)
        @php
        var_dump($user->budgets->where('budgets.updated_at', '!=', 'budgets.created_at')->count())
        @endphp
        @if($user->budgets->count() > 0)
        <x-table.row class="cursor-pointer hover:bg-gray-100">
            <x-table.cell>
                {{$user->name}}
            </x-table.cell>
            @foreach($statuses as $status)
            <x-table.cell>
                {{$user->budgets->where('budgets.updated_at', '=', 'budgets.created_at')->where('budget_status_id', $status->id)->whereBetween('budget_date', [$initial_date, $final_date])->count()}}
            </x-table.cell>
            @endforeach
            <x-table.cell>
                {{$user->budgets->where('budgets.updated_at', '=', 'budgets.created_at')->whereBetween('budget_date', [$initial_date, $final_date])->count()}}
            </x-table.cell>
        </x-table.row>
        @endif
        @endforeach
        <x-table.row class="text-gray-800 cursor-pointer hover:bg-gray-100 dark:text-gray-50">
            <x-table.cell class="font-bold">
                Total Geral
            </x-table.cell>
            @foreach($statuses as $status)
            <x-table.cell class="font-bold">
                {{$orcamentos->where('updated_at', '=', 'created_at')->where('budget_status_id', $status->id)->count()}}
            </x-table.cell>
            @endforeach
            <x-table.cell class="font-bold">
                {{$orcamentos->where('updated_at', '=', 'created_at')->count()}}
            </x-table.cell>
        </x-table.row>
    </x-slot>
</x-table>