<head>
    @livewireStyles
</head>

<body>
    @livewireScripts
    <livewire:welcome />
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content text-center">
            <div class="max-w-xl">
                 <h1 class="text-2xl font-bold pb-6">Olá {{auth()->user()->name}}</h1>
                <div class="grid grid-cols-2 gap-8 ">

                    <a href="{{ url('autorizacao') }}">
                        <button
                            class="btn btn-outline btn-success shadow-md rounded-md p-2 h-auto w-full text-xl text-primary font-bold">

                            <img src="{{ URL::asset('storage/icons/autorizacao.png') }}" class="h-20 w-20 m-2">

                            Autorizações


                        </button>
                    </a>

                    <a href="#">
                        <button
                            class="btn btn-outline btn-success shadow-md rounded-md p-2 h-auto w-full text-xl text-primary font-bold">

                            <img src="{{ URL::asset('storage/icons/ti.png') }}" class="h-20 w-20 m-2">

                            Chamados


                        </button>
                    </a>

                    <a href="#">
                        <button
                            class="btn btn-outline btn-success shadow-md rounded-md p-2 h-auto w-full text-xl text-primary font-bold">

                            <img src="{{ URL::asset('storage/icons/requisicao.png') }}" class="h-20 w-20 m-2">

                            Requisições


                        </button>
                    </a>

                    <a href="#">
                        <button
                            class="btn btn-outline btn-success shadow-md rounded-md p-2 h-auto w-full text-xl text-primary font-bold">

                            <img src="{{ URL::asset('storage/icons/triagem.png') }}" class="h-20 w-20 m-2">

                            Triagem


                        </button>
                    </a>

                    @if(auth()->user()->can('admin'))
                    
                    <a href="{{ url('dashboard') }}">
                        <button
                            class="btn btn-outline btn-success shadow-md rounded-md p-2 h-auto w-full text-xl text-primary font-bold">

                            <img src="{{ URL::asset('storage/icons/seguranca.png') }}" class="h-20 w-20 m-2">

                            TI


                        </button>
                    </a>
                    @endif

                </div>
            </div>
        </div>
    </div>

</body>
