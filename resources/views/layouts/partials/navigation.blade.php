<x-navigation-bar name="Sigma">
    @can('ti')
    <x-slot:sidebar>
        <li>
            <x-side-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                         :active="Request::is('dashboard')" class="w-full">
                <x-icon name="squares"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="ml-3" x-show="expanded">Painel</span>
            </x-side-link>
        </li>

        <li x-data="{open:false}">
            <x-side-link class="w-full" x-on:click="open = ! open" href="#"
                         :active="Request::is('users', 'users/*')">
                <x-icon name="users"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Usuários</span>
                <span><x-icon name="chevron-down" class="w-5 h-5" x-show="expanded"></x-icon></span>
            </x-side-link>
            <ul x-show="open" x-transition
                x-data="{items:[
                            {id: 1, label: 'Todos', link: '{{url('/users')}}', active: 'helpdesk.tickets.create' },
                        {id: 2, label: 'Novo Usuário' , link: '{{url('/users/create')}}' , active: 'helpdesk.tickets' } ]}">
                <template x-for="item in items" :key="item.id">
                    <li x-show="expanded">
                        <x-side-link class="w-full" ::href="item.link">
                                        <span class="flex-1 ml-3 font-light whitespace-nowrap"
                                              x-text="item.label"></span>
                        </x-side-link>
                    </li>
                </template>
            </ul>
        </li>

        <li x-data="{open:false}">
            <x-side-link class="w-full" x-on:click="open = ! open" href="#"
                         :active="Request::is('configuracoes/cargos-e-permissoes', 'configuracoes/*')">
                <x-icon name="cog"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Configurações</span>
            </x-side-link>
            <ul x-show="open" x-transition x-data="{items:[
                            {id: 1, label: 'Cargos e Permissões', link: '{{route('settings.roles-and-permissions')}}', active: 'helpdesk.tickets.create' },
                        {id: 2, label: 'Grupos de Usuários' , link: '{{route('settings.roles-and-permissions')}}' , active: 'helpdesk.tickets' },
                        {id: 3, label: 'Prioridades' , link: '' , active: 'helpdesk.settings.priorities' }, ]}">
                <template x-for="item in items" :key="item.id">
                    <li x-show="expanded">
                        <x-side-link class="w-full" ::href="item.link">
                                        <span class="flex-1 ml-3 font-light whitespace-nowrap"
                                              x-text="item.label"></span>
                        </x-side-link>
                    </li>
                </template>
            </ul>
        </li>

        <li x-data="{open:false}">
            <x-side-link class="w-full" x-on:click="open = ! open" href="#"
                         :active="Request::is('dispositivos', 'dispositivos/*')">
                <x-icon name="desktop-computer"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Dispositivos</span>
            </x-side-link>
            <ul x-show="open" x-transition x-data="{items:[
                        {id: 1, label: 'Todos', link: '{{route('devices.devices')}}', active: 'devices.devices' },
                        {id: 2, label: 'Impressoras', link: '{{route('devices.printers')}}', active: 'devices.printers'}]}">
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
        <li>
            <x-side-link class="w-full" href="#">
                <x-icon name="book-open"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Base de Conhecimento</span>
            </x-side-link>
        </li>
    </x-slot:sidebar>
        @endcan
</x-navigation-bar>