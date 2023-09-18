<div>
        <div class="grid grid-cols-2 gap-2 sm:grid-cols-6">
            <div class="col-span-1 sm:col-span-3">
                {{--
            <x-input-label for="date" value="{{ __('Período') }}" />
            <x-select id="date" name="date" wire:model.defer='submonth' class="block w-full mt-1 input">
                <x-slot name="option">
                    <x-select.option value="1">
                        Últimos 30 Dias
                    </x-select.option>
                    <x-select.option value="2">
                        Últimos 60 Dias
                    </x-select.option>
                    <x-select.option value="3">
                        Últimos 90 Dias
                    </x-select.option>
                </x-slot>
            </x-select>
            @error('submonth')
            <span class="error">{{ $message }}</span>
            @enderror
            --}}

            <span class="flex text-xl text-gray-700 font-regular"> Mostrando resultados dos últrimos 30 dias 
                <x-icon name="refresh" 
                class="w-6 h-6 text-gray-500 cursor-pointer hover:rotate-90" 
                wire:click='generate'> 
                    </x-icon></span>
        </div>
        </div>

    <div class="w-full p-2">
        @livewire('orcamento::dashboard.budget-stats')
    </div>
    <div class="grid grid-cols-1 gap-2 p-2 text-gray-900 dark:text-gray-100 sm:grid-cols-6 ">
        <div class="col-span-1 p-2 sm:col-span-6">
            @livewire('orcamento::dashboard.top-users')
        </div>
        <div class="col-span-1 p-2 bg-white sm:col-span-6 dark:bg-gray-800">
            @livewire('orcamento::dashboard.budget-by-month')
        </div>
        <div class="col-span-1 p-2 bg-white sm:col-span-6 dark:bg-gray-800">
            @livewire('orcamento::dashboard.budget-by-day')
        </div>

    </div>


</div>