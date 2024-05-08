<x-navigation-bar name="Recepção">
    <x-slot:sidebar>
        <li>
            <x-side-link :href="route('recepcao.index')"
                         :active="request()->routeIs('recepcao.index')"
                         class="w-full">
                <x-icon name="home"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="ml-3" x-show="expanded">Inicio</span>
            </x-side-link>
        </li>
        @can(['monitorar filas recepcao'])
            <li x-data="{open:false}">
                <x-side-link class="w-full" x-on:click="open = ! open" href="#"
                             :active="Request::is('helpdesk/painel/chamados', 'helpdesk/painel/chamados/*')">
                    <x-icon name="monitor"
                            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                    </x-icon>
                    <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Monitoramento</span>
                </x-side-link>
                <ul x-show="open" x-transition x-data="{items:[
                            {id: 1, label: 'Fila de Trabalho Médicos', link: '{{route("adm.monitoring")}}', active: 'adm.monitoring' },
                            {id: 2, label: 'Fila de Espera Recepção', link: '{{route("recepcao.monitoring.wait-queue")}}', active: 'request()->routeIs(`recepcao.monitoring.wait-queue`)' },
                            ]}">
                    <template x-for="item in items" :key="item.id">
                        <li x-show="expanded">
                            <x-side-link class="w-full" ::href="item.link" ::active="item.active">
                                <span class="flex-1 ml-3 whitespace-nowrap" x-text="item.label"></span>
                            </x-side-link>
                        </li>
                    </template>
                </ul>
            </li>
        @endcan
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

    </x-slot:sidebar>
</x-navigation-bar>