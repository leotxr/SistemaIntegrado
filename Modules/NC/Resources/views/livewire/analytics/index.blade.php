<div class="py-4">
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
