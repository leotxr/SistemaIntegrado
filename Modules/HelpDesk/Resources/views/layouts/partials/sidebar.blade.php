<x-sidebar>
    <x-slot name="menu">
        <li>
            <x-side-link :href="route('helpdesk.dashboard')" :active="request()->routeIs('helpdesk.dashboard')"
                         :active="Request::is('helpdesk', 'helpdesk/painel')" class="w-full">
                <x-icon name="squares"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="ml-3" x-show="expanded">Painel</span>
            </x-side-link>
        </li>
        <li>
            <x-side-link :href="route('helpdesk.notifications')"
                         :active="request()->routeIs('helpdesk.notifications')" class="w-full">
                <x-icon name="bell" :class="{'text-blue-400': {{auth()->user()->unreadNotifications}}}"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Notificações
                            @livewire('helpdesk::components.notification-dot')
                        </span>

            </x-side-link>
        </li>
        <li x-data="{open:false}">
            <x-side-link class="w-full" x-on:click="open = ! open" href="#"
                         :active="Request::is('helpdesk/painel/chamados', 'helpdesk/painel/chamados/*')">
                <x-icon name="collection"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Chamados</span>
            </x-side-link>
            <ul x-show="open" x-transition x-data="{items:[
                            {id: 1, label: 'Novo', link: '{{route("helpdesk.tickets.create")}}', active: 'helpdesk.tickets.create' },
                            {id: 2, label: 'Encerrados', link: '{{route("helpdesk.tickets")}}', active: 'helpdesk.tickets' },
                            {id: 3, label: 'Prioridades', link: '{{route("helpdesk.settings.priorities")}}', active: 'helpdesk.settings.priorities' },
                            ]}">
                <template x-for="item in items" :key="item.id">
                    <li x-show="expanded">
                        <x-side-link class="w-full" ::href="item.link">
                            <span class="flex-1 ml-3 whitespace-nowrap" x-text="item.label"></span>
                        </x-side-link>
                    </li>
                </template>
            </ul>
        </li>
        <li x-data="{open:false}">
            <x-side-link class="w-full" x-on:click="open = ! open" href="#"
                         :active="Request::is('helpdesk/painel/configuracoes/*')">
                <x-icon name="cog"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Configurações</span>
            </x-side-link>
            <div x-show="open" x-transition>
                <x-side-link class="w-full" :href="route('helpdesk.settings.category')"
                             :active="request()->routeIs('helpdesk.settings.category')">
                    <span class="flex-1 ml-3 whitespace-nowrap">Categorias</span>
                </x-side-link>
                <x-side-link class="w-full" :href="route('helpdesk.settings.sub-category')"
                             :active="request()->routeIs('helpdesk.settings.sub-category')">
                    <span class="flex-1 ml-3 whitespace-nowrap">Sub-Categorias</span>
                </x-side-link>
                <x-side-link class="w-full" :href="route('helpdesk.settings.priorities')"
                             :active="request()->routeIs('helpdesk.settings.priorities')">
                    <span class="flex-1 ml-3 whitespace-nowrap">Prioridades</span>
                </x-side-link>
                <x-side-link class="w-full" :href="route('helpdesk.settings.statuses')"
                             :active="request()->routeIs('helpdesk.settings.statuses')">
                    <span class="flex-1 ml-3 whitespace-nowrap">Status</span>
                </x-side-link>
            </div>
        </li>
        <li x-data="{open:false}">
            <x-side-link class="w-full" x-on:click="open = ! open" href="#"
                         :active="Request::is('helpdesk/painel/relatorios', 'helpdesk/painel/relatorios/*')">
                <x-icon name="document-report"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Relatórios</span>
            </x-side-link>
            <div x-show="open" x-transition>
                <x-side-link class="w-full" href="{{route('helpdesk.reports')}}"
                             :active="request()->routeIs('helpdesk.reports')">
                    <span class="flex-1 ml-3 whitespace-nowrap">Todos</span>
                </x-side-link>
                <x-side-link class="w-full" :href="route('helpdesk.reports.ticket-by-date')"
                             :active="request()->routeIs('helpdesk.reports.ticket-by-date')">
                    <span class="flex-1 ml-3 whitespace-nowrap">Chamados por Período</span>
                </x-side-link>
                <x-side-link class="w-full">
                    <span class="flex-1 ml-3 whitespace-nowrap">Chamados por Categoria</span>
                </x-side-link>
            </div>
        </li>
        <li>
            <x-side-link class="w-full" href="#">
                <x-icon name="book-open"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Base de Conhecimento</span>
            </x-side-link>

        </li>

    </x-slot>
</x-sidebar>
