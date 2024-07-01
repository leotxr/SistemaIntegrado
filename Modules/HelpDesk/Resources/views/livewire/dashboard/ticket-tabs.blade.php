<div>
    <div class="flex space-x-2 overflow-x-auto pb-2">
        @php
            $icons = [
            'clock',
            'play',
            'pause'
            ]
        @endphp
        @foreach($statuses as $key=>$status)
            <div wire:click='selectStatus({{$status->id}})'
                 class="cursor-pointer transition transform duration-200 hover:scale-95"
                 :class="{{$activeStatus}} == {{$status->id}} ? 'scale-95' : ''">
                <x-dashboard-tile>
                    <x-slot:icon>
                        <x-icon name="{{$icons[$key]}}" class="w-8 h-8 text-blue-600"></x-icon>
                    </x-slot:icon>
                    <x-slot:value>{{$status->id === 1 ? $status->tickets->where('user_id', NULL)->count() : $status->tickets->count()}}</x-slot:value>
                    <x-slot:description>{{$status->description}}</x-slot:description>
                </x-dashboard-tile>
            </div>
        @endforeach
        <div wire:click="$set('ticketStatus', false)"
             class="cursor-pointer transition transform duration-200 hover:scale-95"
             :class="{{!$ticketStatus}} ? 'scale-95' : ''">
            <x-dashboard-tile>
                <x-slot:icon>
                    <x-icon name="user-circle" class="w-8 h-8 text-blue-600"/>
                </x-slot:icon>
                <x-slot:value>{{auth()->user()->tickets->whereIn('status_id', [3,4])->count()}}</x-slot:value>
                <x-slot:description>Chamados Vinculados</x-slot:description>
            </x-dashboard-tile>
        </div>
        <div class="cursor-pointer transition transform duration-200 hover:scale-95"
             :class="{{!$ticketStatus}} ? 'scale-95' : ''">
            <x-dashboard-tile>
                <x-slot:icon>
                    <x-icon name="shopping-cart" class="w-8 h-8 text-blue-600"></x-icon>
                </x-slot:icon>
                <x-slot:value>{{$extra_services->count()}}</x-slot:value>
                <x-slot:description>Serviços Extras</x-slot:description>
            </x-dashboard-tile>
        </div>
    </div>


    <div class="w-full">
        <div>
            @if($ticketStatus)
                @include('helpdesk::dashboard.tables.table-tickets')
            @else
                @include('helpdesk::dashboard.tables.table-my-tickets')
            @endif
        </div>
    </div>


    @livewire('helpdesk::tickets.crud.show-ticket')
</div>