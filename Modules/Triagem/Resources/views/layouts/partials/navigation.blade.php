<div class="navbar shadow-lg" data-theme="dark">
    <div class="navbar-start">
        <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </label>
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                @if (auth()->user()->can('admin') ||
                        auth()->user()->can('administrativo'))
                    <li><a href="{{ url('triagem') }}">Painel</a></li>
                    <li tabindex="0">
                        <a>
                            Filas
                            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                            </svg>
                        </a>
                        <ul class="menu menu-compact dropdown-content p-2 shadow bg-base-100 rounded-box w-48">
                            <li><a href="{{ url('triagem/filas/ressonancia') }}">Ressonância</a></li>
                            <li><a href="{{ url('triagem/filas/tomografia') }}">Tomografia</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ url('triagem/terms') }}">Triagens</a></li>
                    <li><a href="{{ url('triagem/relatorios') }}">Relatórios</a></li>
                @endif
            </ul>
        </div>
        <a href="{{ url('welcome') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            @if (auth()->user()->can('admin') ||
                    auth()->user()->can('administrativo'))
                <li><a href="{{ url('triagem') }}">Painel</a></li>
                <li tabindex="0">
                    <a>
                        Filas
                        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 24 24">
                            <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                        </svg>
                    </a>
                    <ul tabindex="0" class="menu menu-compact dropdown-content p-2 shadow bg-base-100 rounded-box w-48">
                        <li><a href="{{ url('triagem/filas/ressonancia') }}">Ressonância</a></li>
                        <li><a href="{{ url('triagem/filas/tomografia') }}">Tomografia</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('triagem/terms') }}">Triagens</a></li>
                <li><a href="{{ url('triagem/relatorios') }}">Relatórios</a></li>
            @endif
        </ul>
    </div>
    <div class="navbar-end">
        {{ auth()->user()->name }}
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img src="{{ URL::asset(auth()->user()->profile_img) }}">
                </div>
            </label>
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
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
