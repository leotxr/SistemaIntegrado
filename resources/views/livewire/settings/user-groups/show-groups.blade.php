<div>
    <div class="pb-2">
        <x-title>Grupos</x-title>
     </div>
    <div class="overflow-auto max-h-56">
    <x-table>
        <x-slot name="head">
            <x-table.heading>Nome</x-table.heading>
            <x-table.heading>Usuários</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @foreach($groups as $group)
            <x-table.row class="cursor-pointer hover:bg-gray-100">
                <x-table.cell>{{$group->name}}</x-table.cell>
                <x-table.cell>{{$group->users->count()}}</x-table.cell>
            </x-table.row>
            @endforeach
        </x-slot>
    </x-table>
    </div>
</div>
