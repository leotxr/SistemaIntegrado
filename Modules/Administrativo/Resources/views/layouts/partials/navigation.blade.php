<x-navigation-bar name="Administrativo">
    <x-slot:sidebar>
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


        <li x-data="{open:false}">
            <x-side-link class="w-full" x-on:click="open = ! open" href="#"
                         :active="Request::is(['administrativo/financeiro','administrativo/financeiro/*'])">
                <x-icon name="cash"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Financeiro</span>
            </x-side-link>
            <ul x-show="open" x-transition>
                <li x-show="expanded">
                    <x-side-link class="w-full cursor-pointer" :href="route('administrativo.financial')"
                                 :active="request()->routeIs('administrativo.financial')">
                        <span class="flex-1 ml-3 whitespace-nowrap">Painel</span>
                    </x-side-link>
                </li>
                <li x-show="expanded" x-data="{submenu:false}">
                    <x-side-link class="w-full cursor-pointer" x-on:click="submenu = ! submenu"
                                 :active="Request::is('administrativo/financeiro/exames-sirius/*')">
                        <span class="flex-1 ml-3 whitespace-nowrap">Exames Sirius</span>
                    </x-side-link>
                    <ul x-show="submenu" x-transition x-data="{items:[
                            {id: 1, label: 'Importar Exames', link: '{{route("administrativo.financial.invoices.create")}}', active: '{{request()->routeIs("administrativo.financial.invoices.create")}}' },
                            {id: 2, label: 'Calcular Pagamento', link: '{{route("administrativo.financial.invoices")}}', active: '{{request()->routeIs("administrativo.financial.invoices")}}' },
                            ]}">
                        <template x-for="item in items" :key="item.id">
                            <li class="text-sm">
                                <x-side-link class="w-full" ::href="item.link" ::active="item.active">
                                    <span class="flex-1 ml-3 whitespace-nowrap" x-text="item.label"></span>
                                </x-side-link>
                            </li>
                        </template>
                    </ul>
                </li>

            </ul>
        </li>
        <li>
            <x-side-link class="w-full" x-on:click="open = ! open" :href="route('administrativo.rh')"
                         :active="request()->routeIs('administrativo.rh')">
                <x-icon name="user-group"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">RH</span>
            </x-side-link>
        </li>
        <li>
            <x-side-link class="w-full" x-on:click="open = ! open" href="#">
                <x-icon name="collection"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Patrimônios</span>
            </x-side-link>
        </li>
        <li>
            <x-side-link class="w-full" x-on:click="open = ! open" :href="route('adm.extra_services.index')" :active="request()->routeIs('adm.extra_services.index')">
                <x-icon name="light-bulb"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                </x-icon>
                <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">Serviços Extras</span>
            </x-side-link>
        </li>
    </x-slot:sidebar>
</x-navigation-bar>