<x-sidebar>
    <x-slot name="menu">
        <li>
            <x-side-link :href="route('laudo.index')"
                         :active="request()->routeIs('laudo.index')"
                         class="w-full">
                <x-icon name="home"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="ml-3" x-show="expanded">Inicio</span>
            </x-side-link>
        </li>
        <li>
            <x-side-link :href="route('laudo.analytics.index')"
                         :active="request()->routeIs('laudo.analytics.index')"
                         class="w-full">
                <x-icon name="monitor"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="ml-3" x-show="expanded">Monitoramento</span>
            </x-side-link>
        </li>
        <li>
            <x-side-link :href="route('laudo.reports.index')"
                         :active="request()->routeIs('laudo.reports.index')"
                         class="w-full">
                <x-icon name="document-report"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="ml-3" x-show="expanded">Relatórios</span>
            </x-side-link>
        </li>
        <li>
            <x-side-link :href="route('recepcao.schedules')"
                         :active="request()->routeIs('recepcao.schedules')"
                         class="w-full">
                <x-icon name="document-search"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="ml-3" x-show="expanded">Laudos Anteriores</span>
            </x-side-link>
        </li>

    </x-slot>
</x-sidebar>
