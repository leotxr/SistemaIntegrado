<x-sidebar>
    <x-slot name="menu">
        <li>
            <x-side-link :href="route('triagem.index')" :active="request()->routeIs('triagem.index')" class="w-full">
                <x-icon name="home"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="ml-3" x-show="expanded">Início</span>
            </x-side-link>
        </li>
        <li x-data="{open:false}">
            <x-side-link class="w-full" x-on:click="open = ! open" href="#"
                         :active="Request::is('triagem/setor/ressonancia', 'triagem/setor/ressonancia/*')">
                <span
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                    RM
                </span>
                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Ressonância</span>
            </x-side-link>
            <ul x-show="open" x-transition x-data="{items:[
                            {id: 1, label: 'Fila de Exames', link: '{{route("filas.ressonancia")}}', active: 'filas.ressonancia' },
                            {id: 2, label: 'Triagens Realizadas', link: '{{route("triagens.realizadas-ressonancia")}}', active: '{{request()->routeIs("triagens.realizadas-ressonancia")}}' },
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
        <li x-data="{open:false}">
            <x-side-link class="w-full" x-on:click="open = ! open" href="#"
                         :active="Request::is('triagem/setor/tomografia', 'triagem/setor/tomografia/*')">
                <span
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                    TC
                </span>
                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Tomografia</span>
            </x-side-link>
            <ul x-show="open" x-transition x-data="{items:[
                            {id: 1, label: 'Fila de Exames', link: '{{route("filas.tomografia")}}', active: 'filas.tomografia' },
                            {id: 2, label: 'Triagens Realizadas', link: '{{route("triagens.realizadas-tomografia")}}', active: '{{request()->routeIs("triagens.realizadas-tomografia")}}' },
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
    </x-slot>
</x-sidebar>
