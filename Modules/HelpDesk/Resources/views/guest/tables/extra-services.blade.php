<div class="2-full">
    {{$extra_services->links()}}
    <x-table>
        <x-slot:head>
            <x-table.heading>Data</x-table.heading>
            <x-table.heading>Solicitante</x-table.heading>
            <x-table.heading>Setor</x-table.heading>
            <x-table.heading>Item</x-table.heading>
            <x-table.heading>Problema</x-table.heading>
            <x-table.heading>Ação Tomada</x-table.heading>
            <x-table.heading>Status</x-table.heading>
        </x-slot:head>
        <x-slot:body>
            @foreach($extra_services as $extra_service)
                <x-table.row>
                    <x-table.cell>{{date('d/m/y', strtotime($extra_service->created_at))}}</x-table.cell>
                    <x-table.cell>{{$extra_service->requester->name . ' ' . $extra_service->requester->lastname}}</x-table.cell>
                    <x-table.cell>{{$extra_service->sector}}</x-table.cell>
                    <x-table.cell>{{$extra_service->item}}</x-table.cell>
                    <x-table.cell>{{$extra_service->title}}</x-table.cell>
                    <x-table.cell>{{$extra_service->action}}</x-table.cell>
                    <x-table.cell>                    <span
                                class="text-sm font-bold mr-2 px-2.5 py-0.5 rounded text-white"
                                style="background-color: {{$colors[$extra_service->status->id]}}">
                       {{$extra_service->status->name}}
                    </span></x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot:body>
    </x-table>
</div>