@if (auth()->user())
    <div class="navbar shadow-md">
        <div class="navbar-start">
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </label>
                <ul tabindex="0"
                    class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                    @if(auth()->user()->can('admin') || auth()->user()->can('administrativo'))
                        <li><a href="{{ url('autorizacao') }}">Painel</a></li>
                    @endif
                    <li><a href="{{ url('autorizacao/create') }}">
                            Nova Autorização</a></li>
                    <li><a href="{{ url('autorizacao/protocols') }}">
                            Minhas Solicitações</a></li>
                    <li><a href="{{ url('autorizacao/relatorioexames') }}">
                            Relatórios</a></li>
                </ul>
            </div>
            <a href="{{ url('welcome') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                @if(auth()->user()->can('admin') || auth()->user()->can('administrativo'))
                    <li><a href="{{ url('autorizacao') }}">Painel</a></li>
                @endif
                <li><a href="{{ url('autorizacao/create') }}">
                        Nova Autorização</a></li>
                <li><a href="{{ url('autorizacao/protocols') }}">
                        Minhas Solicitações</a></li>
                <li><a href="{{ url('autorizacao/relatorioexames') }}">
                        Relatórios</a></li>
            </ul>
        </div>
        <div class="navbar-end">
            {{ auth()->user()->name }}
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src="https://placeimg.com/80/80/people" />
                    </div>
                </label>
                <ul tabindex="0"
                    class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <x-dropdown-link class="justify-between" :href="route('profile.edit')">
                            Perfil

                        </x-dropdown-link>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Sair') }}
                            </x-dropdown-link>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@else
    <script>
        window.location.href = "{{ url('/') }}"
    </script>
@endif
