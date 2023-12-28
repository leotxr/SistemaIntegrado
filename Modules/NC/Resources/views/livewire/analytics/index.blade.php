<div>
    <div>
        <x-title>por usuario</x-title>
        <x-table>
            <x-slot name="head">
                <x-table.heading>Nome</x-table.heading>
                <x-table.heading>Quantidade</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach($ncs as $nc)
                    @if($nc->nonConformities->count() > 0)
                        <x-table.row>
                            <x-table.cell>{{$nc->name}}</x-table.cell>
                            <x-table.cell>{{$nc->nonConformities->count()}}</x-table.cell>
                        </x-table.row>
                    @endif
                @endforeach
            </x-slot>
        </x-table>
    </div>

    <div>
        <x-title>por grupo</x-title>

        <x-table>
            <x-slot name="head">
                <x-table.heading>Nome</x-table.heading>
                <x-table.heading>Quantidade</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach($ncs2 as $group)
                    @if($group->groupNonConformities->count() > 0)
                        <x-table.row>
                            <x-table.cell>{{$group->name}}</x-table.cell>
                            <x-table.cell>{{$group->groupNonConformities->count()}}</x-table.cell>
                        </x-table.row>
                    @endif
                @endforeach
            </x-slot>
        </x-table>

    </div>

    <div>
        <x-title>ncs reponsavel do grupo do coordenador</x-title>

        <x-table>
            <x-slot name="head">
                <x-table.heading>Descricao</x-table.heading>
                <x-table.heading>Identificado por</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach($ncs3 as $nc)
                    <x-table.row>
                        <x-table.cell>{{$nc->description}}</x-table.cell>
                        <x-table.cell>{{$nc->sourceUser->name}}</x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>

    </div>

    <div>
        <x-title>ncs criadas do grupo do coordenador</x-title>

        <x-table>
            <x-slot name="head">
                <x-table.heading>Descricao</x-table.heading>
                <x-table.heading>Identificado por</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach($ncs4 as $nc)
                    <x-table.row>
                        <x-table.cell>{{$nc->description}}</x-table.cell>
                        <x-table.cell>{{$nc->sourceUser->name}}</x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>

    </div>

    <div>
        <x-title>ncs criadas pelo usuario logado</x-title>

        <x-table>
            <x-slot name="head">
                <x-table.heading>Descricao</x-table.heading>
                <x-table.heading>Identificado por</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach($ncs5 as $nc)
                    <x-table.row>
                        <x-table.cell>{{$nc->description}}</x-table.cell>
                        <x-table.cell>{{$nc->sourceUser->name}}</x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>

    </div>

</div>
