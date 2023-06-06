<div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8 py-6 sm:py-6" wire:poll.10000ms>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="bg-white dark:bg-gray-900 h-48">
            <livewire:livewire-column-chart :column-chart-model="$columnChartRM" />
        </div>
        <div class="bg-white dark:bg-gray-900 h-48">
            <livewire:livewire-column-chart :column-chart-model="$columnChartTC" />
        </div>
    </div>
</div>