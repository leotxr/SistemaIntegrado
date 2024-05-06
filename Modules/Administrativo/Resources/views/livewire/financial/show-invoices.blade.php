<div>
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
        <div class="grid grid-cols-4 sm:grid-cols-4 gap-2">
            @livewire('administrativo::financial.partials.last-invoices')
            <div class="grid grid-row-2 sm:grid-rows-2 gap-1">
                <x-dashboard-container height="lg" width="full" colspan="sm:col-span-1 col-span-4"
                                       rowspan="sm:row-span-1 row-span-1">
                    <x-slot:title>Exames este mês</x-slot:title>
                    <x-slot:description>Até o momento este é o total de exames incluídos este mês</x-slot:description>
                    <x-slot:content>
                        <div class="text-center grid content-center">
                            <span class="text-5xl text-gray-600 dark:text-gray-200">{{$count_invoices}}</span>
                        </div>
                    </x-slot:content>
                </x-dashboard-container>

            </div>
        </div>
    </div>
</div>
