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
        @if($user->budgets->count() > 0)
        <x-table.row class="cursor-pointer hover:bg-gray-100">
            <x-table.cell>
                {{$user->name}}
            </x-table.cell>
            @foreach($statuses as $status)
            <x-table.cell>
                {{$user->budgets->where('budget_status_id', $status->id)->whereBetween('budget_date', [$initial_date, $final_date])->where('created_at', '=', 'updated_at')->count()}}
            </x-table.cell>
            @endforeach
            <x-table.cell>
                {{$user->budgets->whereBetween('budget_date', [$initial_date, $final_date])->where('created_at', '=', 'updated_at')->count()}}
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
                {{$orcamentos->where('budget_status_id', $status->id)->where('created_at', '=', 'updated_at')->count()}}
            </x-table.cell>
            @endforeach
            <x-table.cell class="font-bold">
                {{$orcamentos->where('created_at', '=', 'updated_at')->count()}}
            </x-table.cell>
        </x-table.row>
    </x-slot>
</x-table>