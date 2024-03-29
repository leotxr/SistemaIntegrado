<x-table class="text-center">
    <x-slot name="head">
        <x-table.heading>Ações</x-table.heading>
        <x-table.heading>Data Criação</x-table.heading>
        <x-table.heading>Descrição</x-table.heading>
        <x-table.heading>Responsável</x-table.heading>
        <x-table.heading>Data Ocorrência</x-table.heading>
        <x-table.heading>Identificado por</x-table.heading>
        <x-table.heading>Classificação</x-table.heading>
    </x-slot>
    <x-slot name="body">
        @foreach($ncs as $nc)
            <x-table.row class="text-center hover:bg-gray-50 dark:hover:bg-gray-800">
                <x-table.cell>
                    <a type="button" class="cursor-pointer" wire:click="$emit('openModalEdit', {{$nc->id}})">
                        <x-icon name="pencil-alt" class="w-5 h-5"></x-icon>
                    </a>
                </x-table.cell>
                <x-table.cell>{{date('d/m/y', strtotime($nc->created_at))}}</x-table.cell>
                <x-table.cell class="border-r dark:border-gray-700 w-1/2 max-h-16">{{$nc->description}}</x-table.cell>
                <x-table.cell class="">
                    @if($nc->targetUsers->count() > 1)
                        {{$nc->targetUsers->first()->name}} e mais {{$nc->targetUsers->count() - 1}}
                    @else
                        {{$nc->targetUsers->first()->name ?? 'Sem usuário'}}
                    @endif
                </x-table.cell>
                <x-table.cell class="">{{date('d/m/Y', strtotime($nc->n_c_date))}}</x-table.cell>
                <x-table.cell class="">{{$nc->sourceUser->relUserGroup->name}}</x-table.cell>
                <x-table.cell
                    class="">{{$nc->classification->name}} {{$nc->classification->lastname}}</x-table.cell>
            </x-table.row>
        @endforeach
    </x-slot>
</x-table>
