<head>
    @livewireStyles
</head>

<body>
    @livewireScripts
    <livewire:autorizacao::layouts.app />
    <div name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Modulo Autorizacao') }}
        </h2>
    </div>

    <div class="py-12" id="teste">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    <div class="grid grid-cols-1 sm:grid-cols-5 gap-4 font-bold">

                        <div data-value="1" class="btn-status cursor-pointer active:scale-95">
                            <div class="stat shadow-md max-h-auto bg-error">
                                <div class="stat-title">Exames Urgentes</div>
                                <div class="stat-value text-error-content">{{$urgentes}}</div>
                            </div>
                        </div>

                        <div data-value="2" class="btn-status cursor-pointer active:scale-95">
                            <div class="stat shadow-md max-h-auto bg-warning">
                                <div class="stat-title">Exames Pendentes</div>
                                <div class="stat-value text-warning-content">{{$pendentes}}</div>
                            </div>
                        </div>

                        <div data-value="3" class="btn-status cursor-pointer active:scale-95">
                            <div class="stat shadow-md max-h-auto bg-success">
                                <div class="stat-title">Exames Autorizados</div>
                                <div class="stat-value text-success-content">{{$autorizados}}</div>
                            </div>
                        </div>

                        <div data-value="4" class="btn-status cursor-pointer active:scale-95">
                            <div class="stat shadow-md max-h-auto bg-neutral-content">
                                <div class="stat-title">Analise/Negados</div>
                                <div class="stat-value text-neutral">{{$negados}}</div>
                            </div>
                        </div>

                        <div data-value="4" class="btn-status cursor-pointer active:scale-95">
                            <div class="stat shadow-md max-h-auto bg-secondary">
                                <div class="stat-title">Aguardando</div>
                                <div class="stat-value text-secondary-content">{{$aguardando}}</div>
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
