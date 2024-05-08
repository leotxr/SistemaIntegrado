<aside>
    <div id="logo-sidebar"
         class="fixed top-0 left-0 z-40 h-screen pt-20 transition transform duration-300 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700 overflow-hidden"
         :class="!expanded ? '-translate-x-full sm:translate-x-0' : ''"
         aria-label="Sidebar" x-transition>
        <div class="h-full px-2 pb-4  bg-white dark:bg-gray-800 transition-all grid grid-rows-6 content-between"
             @mouseover="expanded = true"
             @mouseleave="expanded = false" :class="expanded ? 'sm:w-64 w-64 shadow-lg' : 'sm:w-14'">
            <ul class="space-y-2 font-medium overflow-x-hidden self-stretch row-span-5" >
                {{$menu}}
            </ul>
            <ul class="font-medium self-end row-span-1" x-data="{dropdown: false}">
                <li>
                    <x-side-link class="w-full cursor-pointer" x-on:click="dropdown = ! dropdown">
                        <x-icon name="user-circle"
                                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                solid>
                        </x-icon>
                        <span class="flex-1 ml-3 whitespace-nowrap" x-show="expanded">{{auth()->user()->name}}</span>
                    </x-side-link>
                    <ul x-show="dropdown"
                        x-data="{items:[
                            {id: 1, label: 'Perfil', link: '{{route('profile.edit')}}', active: 'profile.edit' },
                         ]}">
                        <template x-for="item in items" :key="item.id">
                            <li x-show="expanded">
                                <x-side-link class="w-full cursor-pointer" ::href="item.link">
                                        <span class="flex-1 ml-3 font-light whitespace-nowrap"
                                              x-text="item.label"></span>
                                </x-side-link>
                            </li>
                        </template>
                        <li x-show="expanded">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-side-link class="w-full cursor-pointer" :href="route('logout')" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    <span class="flex-1 ml-3 font-light whitespace-nowrap">Sair</span>
                                </x-side-link>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</aside>

