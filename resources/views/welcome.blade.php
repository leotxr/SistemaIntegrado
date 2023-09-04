<head>
    @livewireStyles
</head>

<body>
    @livewireScripts
    <livewire:welcome />
    <div class="min-h-screen hero">
        <div class="text-center hero-content">
            <div class="max-w-2xl">
                <h1 class="pb-6 text-2xl font-bold text-white">Olá {{ auth()->user()->name }}</h1>
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 ">

                    @can('criar autorizacao')
                    <a href="{{ url('autorizacao') }}">
                        <button class="w-full h-auto p-2 text-xl font-bold text-white rounded-md shadow-md btn glass">

                            <img src="{{ URL::asset('storage/icons/autorizacao.png') }}" class="w-20 h-20 m-2">

                            Autorizações


                        </button>
                    </a>
                    @endcan

                    @cannot('editar chamados')
                    <a href="{{route('helpdesk.guest.index')}}">
                    @endcannot
                    @can('editar chamados')
                    <a href="{{route('helpdesk.dashboard')}}">
                    @endcan
                        <button class="w-full h-auto p-2 text-xl font-bold text-white rounded-md shadow-md btn glass">

                            <img src="{{ URL::asset('storage/icons/ti.png') }}" class="w-20 h-20 m-2">

                            Chamados


                        </button>
                    </a>

                    <a href="#">
                        <button class="w-full h-auto p-2 text-xl font-bold text-white rounded-md shadow-md btn glass">

                            <img src="{{ URL::asset('storage/icons/requisicao.png') }}" class="w-20 h-20 m-2">

                            Requisições


                        </button>
                    </a>
                    @can('ver triagem')
                    <a href="{{ url('triagem') }}">
                        <button class="w-full h-auto p-2 text-xl font-bold text-white rounded-md shadow-md btn glass">

                            <img src="{{ URL::asset('storage/icons/triagem.png') }}" class="w-20 h-20 m-2">

                            Triagem


                        </button>
                    </a>
                    @endcan

                    @can('ver configuracoes')
                        <a href="{{ url('dashboard') }}">
                            <button
                                class="w-full h-auto p-2 text-xl font-bold text-white rounded-md shadow-md btn glass">

                                <img src="{{ URL::asset('storage/icons/seguranca.png') }}" class="w-20 h-20 m-2">

                                TI


                            </button>
                        </a>
                    @endcan

                    @if (auth()->user()->can('criar orcamento'))
                        <a href="{{ url('orcamento') }}">
                            <button
                                class="w-full h-auto p-2 text-xl font-bold text-white rounded-md shadow-md btn glass">

                                <img src="{{ URL::asset('storage/icons/autorizacao.png') }}" class="w-20 h-20 m-2">

                                Orçamentos


                            </button>
                        </a>
                    @endif

                </div>
                <div class="pt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button href="route('logout')"
                        class="w-full h-auto p-2 text-xl font-bold text-white rounded-md shadow-md btn glass"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
