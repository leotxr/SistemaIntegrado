<x-navigation-bar name="Não Conformidades">
    <x-slot:sidebar>
        <li>
            <x-side-link :href="route('nc.index')"
                         :active="request()->routeIs('nc.index')"
                         class="w-full">
                <x-icon name="home"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="ml-3" x-show="expanded">Inicio</span>
            </x-side-link>
        </li>
        @can('excluir ncs')
            <li>
                <x-side-link :href="route('nc.analytics')"
                             :active="request()->routeIs('nc.analytics')"
                             class="w-full">
                    <x-icon name="presentation-chart-line"
                            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                    </x-icon>
                    <span class="ml-3" x-show="expanded">Indicadores</span>
                </x-side-link>
            </li>
            <li>
                <x-side-link :href="route('nc.reports')"
                             :active="Request::is('nc/relatorios/*') "
                             class="w-full">
                    <x-icon name="document-report"
                            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                    </x-icon>
                    <span class="ml-3" x-show="expanded">Relatórios</span>
                </x-side-link>
            </li>
        @endcan
    </x-slot:sidebar>
</x-navigation-bar>