<div>
    <div class="space-y-6 max-w-full">
        <div class="p-2 bg-white shadow sm:p-4 dark:bg-gray-800 sm:rounded-lg">
            <x-accordion>
                <x-slot name="title">
                    <div class="text-gray-900 dark:text-white font-bold justify-start flex mx-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/>
                        </svg>
                        <h1>Filtros<h1>
                    </div>
                </x-slot>
                <x-slot name="content">
                    <div class="max-w-xl">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="initial_date"
                                       class="label text-gray-900 dark:text-gray-50 font-light text-sm">Data
                                    inicial</label>
                                <input type="date" wire:model='initial_date' id="initial_date"
                                       class="input border-gray-300">
                            </div>
                            <div>
                                <label for="final_date"
                                       class="label text-gray-900 dark:text-gray-50 font-light text-sm">Data
                                    Final</label>
                                <input type="date" wire:model='final_date' id="final_date"
                                       class="input border-gray-300">
                            </div>
                        </div>
                    </div>
                </x-slot>
            </x-accordion>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3" wire:poll.10000ms>

            <x-single-stat>
                <x-slot name="title">Ressonância</x-slot>
                <x-slot name="value">{{$stat_rm}}</x-slot>
                <x-slot name="statistic"></x-slot>
                <x-slot name="description">{{now()->format('d/m/y')}}</x-slot>
            </x-single-stat>
            <x-single-stat>
                <x-slot name="title">RM Subsolo</x-slot>
                <x-slot name="value">{{$stat_rm_sub}}</x-slot>
                <x-slot name="statistic"></x-slot>
                <x-slot name="description">{{now()->format('d/m/y')}}</x-slot>
            </x-single-stat>
            <x-single-stat>
                <x-slot name="title">Tomografia</x-slot>
                <x-slot name="value">{{$stat_tc}}</x-slot>
                <x-slot name="statistic"></x-slot>
                <x-slot name="description">{{now()->format('d/m/y')}}</x-slot>
            </x-single-stat>

        </div>

    </div>
</div>