{{-- <aside x-data="{expanded: false}">
    <div id="logo-sidebar"
         class="fixed top-0 left-0 z-40 h-screen pt-20 transition transform duration-300 -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
         aria-label="Sidebar" x-transition>
        <div class="h-full px-2 pb-4  bg-white dark:bg-gray-800 transition-all grid grid-rows-2 content-between"
             @mouseover="expanded = true"
             @mouseleave="expanded = false" :class="expanded ? 'sm:w-64 shadow-lg' : 'sm:w-14'">
            <ul class="space-y-2 font-medium">
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
            </ul>
            <ul class="font-medium self-end">
                <li>
                    <x-side-link class="w-full" href="#">
                        <x-icon name="user-circle"
                                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                solid>
                        </x-icon>
                        <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">{{auth()->user()->name}}</span>
                    </x-side-link>
                </li>
            </ul>
        </div>
    </div>
</aside>
--}}

<x-sidebar>
    <x-slot name="menu">

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

    </x-slot>
</x-sidebar>
