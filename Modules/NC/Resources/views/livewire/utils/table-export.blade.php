<div>
    <x-table class="text-center">
        <x-slot name="head">
            <x-table.heading>Descrição</x-table.heading>
            <x-table.heading>Responsável</x-table.heading>
            <x-table.heading>Data</x-table.heading>
            <x-table.heading>Identificado por</x-table.heading>
            <x-table.heading>Classificação</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @foreach($ncs as $nc)
                <x-table.row class="text-center hover:bg-gray-50">
                    <x-table.cell class="border-r w-1/2 max-h-16">{{$nc->description}}</x-table.cell>
                    <x-table.cell class="">
                        @foreach($nc->targetusers as $user)
                            <span>{{$user->name}} {{$user->lastname}} ,</span>
                        @endforeach
                    </x-table.cell>
                    <x-table.cell class="">{{date('d/m/Y', strtotime($nc->n_c_date))}}</x-table.cell>
                    <x-table.cell class="">{{$nc->sourceUser->name}}</x-table.cell>
                    <x-table.cell
                        class="">{{$nc->classification->name}} {{$nc->classification->lastname}}</x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table>
</div>
