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
        <div x-data="{ tab: @entangle('tab') }"
             id="tab_wrapper">
            <!-- The tabs navigation -->
            <x-nc::tab>
                <x-nc::tab.button wire:click="$set('tab', 'created_by_me')" :active="$tab === 'created_by_me'">
                    Criadas por mim
                </x-nc::tab.button>
                @can('editar ncs')
                    <x-nc::tab.button wire:click="$set('tab', 'created_by_group')"
                                      :active="$tab === 'created_by_group'">
                        Criadas pelo Setor
                    </x-nc::tab.button>
                    <x-nc::tab.button wire:click="$set('tab', 'group_nc')" :active="$tab === 'group_nc'">
                        Recebidas para o Setor
                    </x-nc::tab.button>
                @endcan
                @can('excluir ncs')
                    <x-nc::tab.button wire:click="$set('tab', 'all')" :active="$tab === 'all'">
                        Todas
                    </x-nc::tab.button>
                @endcan
            </x-nc::tab>

            <div>
                <div wire:loading.delay.longest>
                    @livewire('nc::utils.loading-screen')
                </div>
                {!! $ncs->links() !!}
                <div>
                    @include('nc::user.utils.dashboard-table')
                </div>
            </div>

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
