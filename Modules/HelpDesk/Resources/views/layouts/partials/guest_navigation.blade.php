<x-navigation-bar name="HelpDesk">
<x-slot:sidebar>
    <li>
        <x-side-link :href="route('helpdesk.guest.index')" :active="request()->routeIs('helpdesk.guest.index')"
                     :active="Request::is('helpdesk', 'helpdesk/chamados')" class="w-full">
            <x-icon name="home"
                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
            </x-icon>
            <span class="ml-3" x-show="expanded">Início</span>
        </x-side-link>
    </li>
    <li>
        <x-side-link :href="route('helpdesk.guest.create')" :active="request()->routeIs('helpdesk.guest.create')"
                     :active="Request::is('helpdesk', 'helpdesk/chamados/novo')" class="w-full">
            <x-icon name="ticket"
                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
            </x-icon>
            <span class="ml-3" x-show="expanded">Novo chamado</span>
        </x-side-link>
    </li>
</x-slot:sidebar>
</x-navigation-bar>