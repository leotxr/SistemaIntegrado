<div class="overflow-auto max-h-80">
    <x-table>
        <x-slot name="head">
            <x-table.heading>Atendente</x-table.heading>
            <x-table.heading>Agendados</x-table.heading>
            <x-table.heading>Não Agendados</x-table.heading>
            <x-table.heading>Total</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @foreach($users as $user)
            <x-table.row>
                <x-table.cell>{{$user->name}}</x-table.cell>
                <x-table.cell>{{$user->relBudgets->count()}}</x-table.cell>
                <x-table.cell>{{$user->relBudgets->count()}}</x-table.cell>
                <x-table.cell>{{$user->relBudgets->count()}}</x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>
    </x-table>

</div>