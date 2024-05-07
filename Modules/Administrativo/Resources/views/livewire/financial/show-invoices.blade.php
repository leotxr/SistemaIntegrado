<div class="divide-y-2 divide-gray-300 dark:divide-gray-700 space-y-2">
    <div class="w-full">
        @livewire('administrativo::financial.partials.invoices-by-filter')
    </div>
    <div class="w-full">
        <div class="p-2 grid justify-items-end">
            <x-primary-button type="button">
                <a class="flex" href="{{route('administrativo.financial.invoices.create')}}">
                    <x-icon name="plus" class="w-5 h-5 text-white"></x-icon>
                    <span> Novo exame</span>
                </a>
            </x-primary-button>
        </div>
        <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
            <div class="col-span-4 sm:col-span-4">
                @livewire('administrativo::financial.partials.last-invoices')
            </div>
            <div class="col-span-4 sm:col-span-2">
                @livewire('administrativo::financial.partials.chart-invoices-month')
            </div>
        </div>
    </div>
</div>
