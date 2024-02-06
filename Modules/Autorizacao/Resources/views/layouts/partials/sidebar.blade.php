<aside x-data="{expanded: false}">
    <div id="logo-sidebar"
         class="fixed top-0 left-0 z-40 h-screen pt-20 transition transform duration-300 -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
         aria-label="Sidebar" x-transition>
        <div class="h-full px-2 pb-4 overflow-y-auto bg-white dark:bg-gray-800 transition-all"
             @mouseover="expanded = true"
             @mouseleave="expanded = false" :class="expanded ? 'sm:w-64 shadow-lg' : 'sm:w-14'">
            <ul class="space-y-2 font-medium">
                @can(['editar autorizacao', 'excluir autorizacao'])
                    <li>
                        <x-side-link :href="route('autorizacao.index')"
                                     :active="request()->routeIs('autorizacao.index')"
                                     :active="Request::is('autorizacao')" class="w-full">
                            <x-icon name="squares"
                                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                            </x-icon>
                            <span class="ml-3" x-show="expanded">Painel</span>
                        </x-side-link>
                    </li>
                @endcan

                <li x-data="{open:false}">
                    <x-side-link class="w-full" x-on:click="open = ! open" href="#"
                                 :active="Request::is('autorizacao/nova-solicitacao', 'autorizacao/minhas-solicitacoes')"
                    >
                        <x-icon name="clipboard-check"
                                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                        </x-icon>
                        <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Autorizações</span>
                    </x-side-link>
                    <ul x-show="open" x-transition
                        x-data="{items:[
                            {id: 1, label: 'Nova Solicitação', link: '{{route('autorizacao.create')}}', active: 'autorizacao.create' },
                        {id: 2, label: 'Minhas Solicitações' , link: '{{route('autorizacao.myprotocols')}}' , active: 'autorizacao.myprotocols' } ]}">
                        <template x-for="item in items" :key="item.id">
                            <li x-show="expanded">
                                <x-side-link class="w-full" ::href="item.link"
                                             ::active="request()->routeIs(item.active)">
                                        <span class="flex-1 ml-3 font-light whitespace-nowrap"
                                              x-text="item.label"></span>
                                </x-side-link>
                            </li>
                        </template>
                    </ul>
                </li>

                @can(['editar autorizacao', 'excluir autorizacao'])

                    <li x-data="{open:false}">
                        <x-side-link class="w-full" x-on:click="open = ! open" href="#"
                                     :active="Request::is('autorizacao/relatorio')">
                            <x-icon name="document-report"
                                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                            </x-icon>
                            <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Relatórios</span>
                        </x-side-link>
                        <ul x-show="open" x-transition x-data="{items:[
                        {id: 1, label: 'Relatório de Autorizações', link: '{{route('autorizacao.exam-report')}}', active: 'autorizacao.exam-report' }
                        ]}">
                            <template x-for="item in items" :key="item.id">
                                <li x-show="expanded">
                                    <x-side-link class="w-full" ::href="item.link" ::active="item.active">
                                        <span class="flex-1 ml-3 font-light whitespace-nowrap"
                                              x-text="item.label"></span>
                                    </x-side-link>
                                </li>
                            </template>
                        </ul>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</aside>

