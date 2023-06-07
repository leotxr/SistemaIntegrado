<div class="py-6 mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8 sm:py-6" wire:poll.10000ms>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="h-48 bg-white dark:bg-gray-900">
            <livewire:livewire-column-chart :column-chart-model="$columnChartRM" />
        </div>
        <div class="h-48 bg-white dark:bg-gray-900">
            <livewire:livewire-column-chart :column-chart-model="$columnChartTC" />
        </div>
    </div>
</div>