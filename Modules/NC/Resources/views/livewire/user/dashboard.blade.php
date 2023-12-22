<div x-data="{openFilter: false}">
    @livewire('nc::utils.dashboard-filter')
    <div class="w-full flex justify-end px-2">
        <x-primary-button class="bg-blue-600" wire:click="$emit('openModalCreate')">+ Nova Não Conformidade
        </x-primary-button>
    </div>
    <div>
        <span
            class="text-gray-500 text-sm">Mostrando resultados entre {{date('d/m/Y', strtotime($start_date))}} e {{date('d/m/Y', strtotime($end_date))}}</span>
    </div>
    <div class="bg-white dark:bg-gray-800 pb-8 rounded-md">
        <div class="p-2">
            {!! $ncs->links() !!}
        </div>
        <div>
            @include('nc::user.utils.dashboard-table')
        </div>
    </div>
    @livewire('nc::forms.create'){{-- Form modal create --}}
    @livewire('nc::forms.edit')

    <div class="fixed bottom-4 right-4 ">
        <button
            wire:click="export"
            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-2 rounded-full shadow-lg hover:scale-115 transition transform duration-75">
            <x-icon name="table" class="h-6 w-6 text-white"></x-icon>
        </button>
        <button
            wire:click="$emit('openModalCreate')"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-4 px-4 rounded-full shadow-lg hover:rotate-90 transition transform duration-75">
            <x-icon name="plus" class="h-8 w-8 text-white"></x-icon>
        </button>
    </div>
</div>
