<div>
    <div class="flex justify-end m-2">
        <a type="button" href="{{route('helpdesk.guest.create')}}"
           class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Novo
            Chamado</a>
    </div>
    <div class="flex justify-center w-full p-4 bg-white dark:bg-gray-900">
        <div x-data="{ tab: @entangle('tab') }" id="tab_wrapper"
             class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
            <!-- The tabs navigation -->
            <x-nc::tab>
                <x-nc::tab.button :active="$tab === 'ativos'"
                                  class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                  wire:click="$set('tab', 'ativos')" href="#">Meus Chamados Ativos
                </x-nc::tab.button>
                <x-nc::tab.button :active="$tab === 'encerrados'"
                                  class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                  wire:click="$set('tab', 'encerrados')" href="#">Meus Chamados
                    Encerrados
                </x-nc::tab.button>
            </x-nc::tab>

            <!-- The tabs content -->
            <div x-show="tab === 'ativos'">
                @if(count($tickets) > 0)
                    @include('helpdesk::guest.tables.active-tickets')
                @else
                    <div>
                        <x-title>Não existem chamados ativos.</x-title>
                        <img src="{{URL::asset('storage/icons/vazio.png')}}" class="max-w-96 max-h-96">
                        <a type="button" href="{{route('helpdesk.guest.create')}}"
                           class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none w-full focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Abrir
                            um Chamado</a>
                    </div>
                @endif
            </div>
            <div x-show="tab === 'encerrados'">
                @if(count($closed) > 0)
                    @include('helpdesk::guest.tables.closed-tickets')
                @else
                    <div>
                        <x-title>Não existem chamados encerrados.</x-title>
                        <img src="{{URL::asset('storage/icons/vazio.png')}}" class="max-w-96 max-h-96">
                        <a type="button" href="{{route('helpdesk.guest.create')}}"
                           class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none w-full focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Abrir
                            um Chamado</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
