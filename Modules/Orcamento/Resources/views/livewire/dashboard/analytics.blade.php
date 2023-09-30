<div wire:poll.60000ms='refreshChildren'>
    <div class="grid grid-cols-2 gap-2 px-4 sm:grid-cols-6">
        <div class="col-span-1 sm:col-span-2">
            <x-input-label for="date" value="{{ __('Período') }}" />
            <x-select id="date" name="date" wire:model='submonth' class="block w-full mt-1 rounded-none input">
                <x-slot name="option">
                    <x-select.option value="0">
                        Hoje
                    </x-select.option>
                    <x-select.option value="7">
                        Últimos 7 Dias
                    </x-select.option>
                    <x-select.option value="15">
                        Últimos 15 Dias
                    </x-select.option>
                    <x-select.option value="30">
                        Últimos 30 Dias
                    </x-select.option>
                    <x-select.option value="60">
                        Últimos 60 Dias
                    </x-select.option>
                </x-slot>
            </x-select>
            @error('submonth')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-span-1 sm:mt-6 sm:col-span-1">
            <x-primary-button type="button" wire:click='refreshChildren' class="h-full rounded-none">Atualizar</x-primary-button>
        </div>
        <div class="col-span-1 sm:col-span-2 sm:mt-8">
            <span>Última Atualização: {{now()}}</span>
        </div>

    </div>


    <div class="grid grid-cols-1 gap-2 p-2 text-gray-900 dark:text-gray-100 sm:grid-cols-6 ">
        <div class="w-full col-span-1 p-2 sm:col-span-6">
           
    
            @livewire('orcamento::dashboard.budget-stats', ['submonth' => $submonth])
    
        </div>
        <div class="w-full col-span-1 p-2 sm:col-span-6">
           
            @livewire('orcamento::dashboard.top-users', ['submonth' => $submonth])
           
        </div>
        <div class="col-span-1 p-2 bg-white sm:col-span-6 dark:bg-gray-800">
            {{--
            @livewire('orcamento::dashboard.budget-by-month')
            --}}
        </div>
        <div class="col-span-1 p-2 bg-white sm:col-span-6 dark:bg-gray-800">
            {{--
            @livewire('orcamento::dashboard.budget-by-day')
            --}}
        </div>

    </div>


</div>