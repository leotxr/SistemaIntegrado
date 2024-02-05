<div>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button
                        x-on:click="expanded = !expanded"
                        type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="/" class="flex ml-2 md:mr-24">
                        <x-application-logo class="block w-auto mr-2 text-gray-800 fill-current h-9 dark:text-gray-200">
                        </x-application-logo>
                        <span class="self-center text-xl font-bold sm:text-2xl whitespace-nowrap dark:text-white">
                        Não Conformidades</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ml-3">
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <button id="theme-toggle" type="button"
                                    class="mx-4 text-sm text-gray-500 rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700">
                                <x-icon id="theme-toggle-dark-icon" name="moon" class="hidden h-5 w-5"></x-icon>
                                <x-icon id="theme-toggle-light-icon" name="sun" class="hidden h-5 w-5"></x-icon>
                            </button>
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ml-1">
                                            <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </nav>

    <aside x-data="{expanded: false}">
        <div id="logo-sidebar"
             class="fixed top-0 left-0 z-40 h-screen pt-20 transition transform duration-300 -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
             aria-label="Sidebar" x-transition>
            <div class="h-full px-2 pb-4 overflow-y-auto bg-white dark:bg-gray-800 transition-all"
                 @mouseover="expanded = true"
                 @mouseleave="expanded = false" :class="expanded ? 'sm:w-64' : 'sm:w-14'">
                <ul class="space-y-2 font-medium w-full">
                    <li>
                        <x-side-link :href="route('nc.index')"
                                     :active="request()->routeIs('nc.index')"
                                     class="w-full">
                            <x-icon name="home"
                                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-50 group-hover:text-gray-900 dark:group-hover:text-white">
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
                                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-50 group-hover:text-gray-900 dark:group-hover:text-white">
                                </x-icon>
                                <span class="ml-3" x-show="expanded">Indicadores</span>
                            </x-side-link>
                        </li>
                        <li>
                            <x-side-link :href="route('nc.reports')"
                                         :active="Request::is('nc/relatorios/*') "
                                         class="w-full">
                                <x-icon name="document-report"
                                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-50 group-hover:text-gray-900 dark:group-hover:text-white">
                                </x-icon>
                                <span class="ml-3" x-show="expanded">Relatórios</span>
                            </x-side-link>
                        </li>
                    @endcan
                    {{--
                                        <li x-data="{open:false}" @click="expanded = true">
                                            <x-side-link class="w-full" x-on:click="open = ! open" href="#"
                                                                 :active="Request::is('gestao/laudo/indicadores/*')">
                                                <x-icon name="presentation-chart-line"
                                                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-50 group-hover:text-gray-900 dark:group-hover:text-white">
                                                </x-icon>
                                                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Indicadores</span>
                                            </x-side-link>
                                            <ul x-show="open" x-transition x-data="{items:[
                                                {id: 1, label: 'Laudo', link: '{{route("gestao.laudo.analytics.index")}}', active: 'gestao.laudo.analytics.index' },
                                                {id: 2, label: 'Recepção', link: '{{route("gestao.pending-exams")}}', active: 'helpdesk.pending-exams' },

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
                                        --}}
                </ul>
            </div>
        </div>
    </aside>
</div>
