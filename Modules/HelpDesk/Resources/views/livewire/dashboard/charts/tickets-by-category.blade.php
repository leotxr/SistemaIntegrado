<div>
    <div class="px-4 py-6 bg-white rounded-lg shadow-md dark:bg-gray-800 ">
        <x-title>Chamados por categoria</x-title>
        <span class="text-xs font-light text-gray-500">Exibe o total de chamados por categoria no mês atual.</span>
        <div class="h-48">
            <livewire:livewire-column-chart key="{{ $TicketsPorCategoria->reactiveKey() }}"
                :column-chart-model="$TicketsPorCategoria" />
        </div>
    </div>
</div>
