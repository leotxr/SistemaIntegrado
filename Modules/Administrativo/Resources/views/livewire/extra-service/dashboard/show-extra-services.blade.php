<div>
    @php
        $icons = [
        'clock',
        'pause',
        'play']
    @endphp
    <div class="flex space-x-2 overflow-x-auto pb-2">
        @foreach($statuses as $key=>$status)
            <div class="cursor-pointer transition transform duration-200 hover:scale-95"
                 :class="{{$selected_status}} == {{$status->id}} ? 'scale-95' : ''"
                 wire:click="$set('selected_status', {{$status->id}})">
                <x-dashboard-tile>
                    <x-slot:icon>
                        <x-icon name="{{$icons[$key]}}" class="w-8 h-8 text-blue-600"></x-icon>
                    </x-slot:icon>
                    <x-slot:value>{{$status->services->count()}}</x-slot:value>
                    <x-slot:description>{{$status->description}}</x-slot:description>
                </x-dashboard-tile>
            </div>
        @endforeach
    </div>
    <div>
        @php
            $status = \Modules\HelpDesk\Entities\TicketStatus::find($selected_status);
        @endphp
        <x-title class="text-xl p-2">{{$status->description}}</x-title>
        {{$extra_services->links()}}
        <div class="text-center">
            <x-table>
                <x-slot:head>
                    <x-table.heading>Data</x-table.heading>
                    <x-table.heading>Solicitante</x-table.heading>
                    <x-table.heading>Setor</x-table.heading>
                    <x-table.heading>Item</x-table.heading>
                    <x-table.heading>Problema</x-table.heading>
                    <x-table.heading>Ação</x-table.heading>
                </x-slot:head>
                <x-slot:body>
                    @foreach($extra_services as $extra_service)
                        <x-table.row wire:click="$emit('editService', {{$extra_service->id}})" class="cursor-pointer">
                            <x-table.cell>{{date('d/m/y', strtotime($extra_service->created_at))}}</x-table.cell>
                            <x-table.cell>{{$extra_service->requester->name . ' ' . $extra_service->requester->lastname}}</x-table.cell>
                            <x-table.cell>{{$extra_service->sector}}</x-table.cell>
                            <x-table.cell>{{$extra_service->item}}</x-table.cell>
                            <x-table.cell>{{$extra_service->title}}</x-table.cell>
                            <x-table.cell>{{$extra_service->action}}</x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-slot:body>
            </x-table>
        </div>
    </div>
    @livewire('administrativo::extra-service.dashboard.edit-extra-service')
</div>