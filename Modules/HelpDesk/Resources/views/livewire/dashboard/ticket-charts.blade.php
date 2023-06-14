<div>
    <div class="py-2 mx-auto space-y-2 max-w-7xl" wire:poll.10000ms>
        <div class="p-4 bg-white rounded-lg shadow-md h-60 dark:bg-gray-800">
            <livewire:livewire-area-chart
            key="{{ $TicketsPorDia->reactiveKey() }}"
            :area-chart-model="$TicketsPorDia"
        />
        </div>
        <div class="p-4 bg-white rounded-lg shadow-md h-60 dark:bg-gray-800">
           
        </div>

    </div>
</div>