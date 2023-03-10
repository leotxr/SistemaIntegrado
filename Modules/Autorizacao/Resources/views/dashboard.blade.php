<head>
    @livewireStyles
</head>

<body>
    @if (auth()->user())
        @livewireScripts
        <livewire:autorizacao::layouts.app />
        <div name="header">
            <h2 class="font-semibold text-2xl leading-tight">
                {{ __('Módulo Autorização') }}
            </h2>
        </div>

        @if (auth()->user()->can('admin') ||
                auth()->user()->can('administrativo'))
            <div class="py-12 shadow-md bg-base-100" id="teste">
                <div class="max-w-screen-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 ">
                            <div class="grid grid-cols-1 sm:grid-cols-5 gap-4 font-bold">

                                <div data-value="1" class="btn-status cursor-pointer active:scale-95">
                                    <div class="stat shadow-md max-h-auto rounded-lg bg-error">
                                        <div class="stat-title">Exames Urgentes</div>
                                        <div class="stat-value text-error-content">{{ $urgentes }}</div>
                                    </div>
                                </div>

                                <div data-value="2" class="btn-status cursor-pointer active:scale-95">
                                    <div class="stat shadow-md max-h-auto bg-warning rounded-lg">
                                        <div class="stat-title">Exames Pendentes</div>
                                        <div class="stat-value text-warning-content">{{ $pendentes }}</div>
                                    </div>
                                </div>

                                <div data-value="3" class="btn-status cursor-pointer active:scale-95">
                                    <div class="stat shadow-md max-h-auto bg-success rounded-lg">
                                        <div class="stat-title">Autorizados/Negados</div>
                                        <div class="stat-value text-success-content">{{ $autneg }}</div>
                                    </div>
                                </div>

                                <div data-value="4" class="btn-status cursor-pointer active:scale-95">
                                    <div class="stat shadow-md max-h-auto bg-neutral-content rounded-lg">
                                        <div class="stat-title">Analise</div>
                                        <div class="stat-value text-neutral">{{ $analise }}</div>
                                    </div>
                                </div>

                                <div data-value="5" class="btn-status cursor-pointer active:scale-95">
                                    <div class="stat shadow-md max-h-auto bg-secondary rounded-lg">
                                        <div class="stat-title">Exames Futuros</div>
                                        <div class="stat-value text-secondary-content">{{ $futuro }}</div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="p-6 ">
                            <div class="border border-2 responsive" id="table-autorizacao">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(auth()->user()->can('telefonia'))
            <script>
                window.location.href = "{{ url('autorizacao/create') }}"
            </script>
        @endif
    @else
        <script>
            window.location.href = "{{ url('/') }}"
        </script>
    @endif

</body>
<script>
    $(document).ready(function() {
        $(".btn-status").click(function() {
            const url = "{{ route('showlistaut') }}";
            status = $(this).attr('data-value');
            $.ajax({
                url: url,
                data: {
                    'status': status,
                },
                success: function(data) {
                    $("#table-autorizacao").html(data);
                }
            });
        });
    });


  


    
</script>
