<x-sidebar>
    <x-slot name="menu">
        @can(['editar autorizacao', 'excluir autorizacao'])
            <li>
                <x-side-link :href="route('administrativo.index')"
                             :active="request()->routeIs('administrativo.index')"
                             :active="Request::is('administrativo')" class="w-full">
                    <x-icon name="home"
                            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                    </x-icon>
                    <span class="ml-3" x-show="expanded">Início</span>
                </x-side-link>
            </li>
        @endcan

        <li x-data="{open:false}">
            <x-side-link class="w-full" x-on:click="open = ! open" href="#"
                         :active="Request::is('administrativo/financeiro/exames-sirius/nova')">
                <x-icon name="calculator"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Financeiro</span>
            </x-side-link>
            <ul x-show="open" x-transition>
                <li x-show="expanded">
                    <x-side-link class="w-full cursor-pointer" :href="route('administrativo.financial')" :active="request()->routeIs('administrativo.financial')">
                        <span class="flex-1 ml-3 whitespace-nowrap">Painel</span>
                    </x-side-link>
                </li>
                <li x-show="expanded" x-data="{submenu:false}">
                    <x-side-link class="w-full cursor-pointer" x-on:click="submenu = ! submenu">
                        <span class="flex-1 ml-3 whitespace-nowrap">Exames Sirius</span>
                    </x-side-link>
                    <ul x-show="submenu" x-transition x-data="{items:[
                            {id: 1, label: 'Importar Exames', link: '{{route("administrativo.financial.invoices.create")}}', active: 'administrativo.financial' },
                            {id: 2, label: 'Calcular Pagamento', link: '{{route("administrativo.financial.invoices")}}', active: 'administrativo.financial' },
                            ]}">
                        <template x-for="item in items" :key="item.id">
                            <li class="text-sm">
                                <x-side-link class="w-full" ::href="item.link">
                                    <span class="flex-1 ml-3 whitespace-nowrap" x-text="item.label"></span>
                                </x-side-link>
                            </li>
                        </template>
                    </ul>
                </li>

            </ul>
        </li>
    </x-slot>
</x-sidebar>

