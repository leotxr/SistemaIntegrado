<div class="space-y-4">
    <div class="grid grid-cols-2 sm:grid-cols-6 gap-2">
        <div class="col-span-2 sm:col-span-1">
            <x-input-label for="start_date">Data Inicial</x-input-label>
            <x-text-input id="start_date" name="start_date" wire:model="start_date" type="date" class="w-full"></x-text-input>
        </div>
        <div class="col-span-2 sm:col-span-1">
            <x-input-label for="end_date">Data Final</x-input-label>
            <x-text-input id="end_date" name="end_date" wire:model="end_date" type="date" class="w-full"></x-text-input>
        </div>
        <div class="col-span-2 sm:col-span-1 grid content-center">
            <x-primary-button type="submit" class="block" wire:click="refreshChildren"><x-icon name="refresh" class="w-5 h-5"></x-icon> Atualizar</x-primary-button>
        </div>

    </div>
    <div class="grid sm:grid-cols-6 grid-cols-4 gap-4">
        <div class="col-span-4 sm:col-span-3">
            @livewire('nc::analytics.partials.created-by-sector', ['start_date' => $start_date, 'end_date' => $end_date])
        </div>
        <div class="col-span-4 sm:col-span-3">
            @livewire('nc::analytics.partials.received-by-sector', ['start_date' => $start_date, 'end_date' => $end_date])
        </div>
        <div class="col-span-4 sm:col-span-3">
            @livewire('nc::analytics.partials.top-created-users', ['start_date' => $start_date, 'end_date' => $end_date])
        </div>
        <div class="col-span-4 sm:col-span-3">
            @livewire('nc::analytics.partials.top-received-users', ['start_date' => $start_date, 'end_date' => $end_date])
        </div>
    </div>
    <div class="text-center">
        <span
            class="text-gray-500 dark:text-gray-400 text-sm">Mostrando resultados de {{$start_date}} até {{$end_date}}</span>
        <span class="text-gray-500 dark:text-gray-400 text-sm">Última atualização: {{now()}}</span>
    </div>
</div>
