<div wire:poll.300000ms>
    <div class="grid gap-3 py-2 mx-auto space-y-2 lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-1" >
        <div class="px-4 py-6 bg-white rounded-lg shadow-md dark:bg-gray-800 ">
            <x-title>Chamados abertos por dia</x-title>
            <span class="text-xs font-light text-gray-500">Exibe o total de chamados abertos dos nos ultimos 5 dias</span>
            <div class="h-48">
                <livewire:livewire-area-chart key="{{ $TicketsPorDia->reactiveKey() }}"
                    :area-chart-model="$TicketsPorDia" />
            </div>
        </div>
        <div class="px-4 py-6 bg-white rounded-lg shadow-md dark:bg-gray-800 ">
            <x-title>Chamados abertos por setor</x-title>
            <span class="text-xs font-light text-gray-500">Exibe o total de chamados abertos por setor no mês atual</span>
            <div class="h-48">
                <livewire:livewire-column-chart key="{{ $TicketsPorSetor->reactiveKey() }}"
                    :column-chart-model="$TicketsPorSetor" />
            </div>
        </div>

    </div>

    <x-modal.dialog wire:model.defer='modalChart'>
        <x-slot name='title'>
            <x-title> Chamados Abertos </x-title>
        </x-slot>
        <x-slot name='content'>

            @include('helpdesk::dashboard.tables.table-tickets-modal')
            

        </x-slot>
        <x-slot name='footer' class="space-x-4">

        </x-slot>
    </x-modal.dialog>

</div>