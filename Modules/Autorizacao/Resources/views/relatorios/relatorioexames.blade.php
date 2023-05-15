<head>
    @livewireStyles
</head>
@if (auth()->user()->id)

    <body>
        @livewireScripts
        <livewire:autorizacao::layouts.app />
        <div name="header">
            <h2 class="font-semibold text-2xl leading-tight">
                {{ __('Relatório de Solicitações') }}
            </h2>
        </div>

        <form method="POST">
            @csrf
            <div class="py-12" id="teste">
                <div class="max-w-screen-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-sm sm:rounded-lg text-center bg-base-100">
                        <div class="p-6 text-center">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 font-bold">

                                <div>
                                    <label for="data-inicio">
                                        Data Inicial
                                        <input type="datetime-local" name="data-inicial" id="data_inicial"
                                            class="input input-bordered w-full max-w-xs">
                                    </label>
                                </div>

                                <div>
                                    <label for="data-final">
                                        Data Final
                                        <input type="datetime-local" name="data-final" id="data_final"
                                            class="input input-bordered w-full max-w-xs">
                                    </label>
                                </div>

                                <div>
                                    <label for="status">
                                        Status do Exame
                                        <select name="status" id="status" class="select select-bordered w-full max-w-xs">
                                            <option disabled selected>Status</option>
                                            <option>Todos</option>
                                            <option value="1">AUTORIZADO</option>
                                            <option value="2">NEGADO</option>
                                            <option value="3">PENDENTE</option>
                                            <option value="4">FUTURO</option>
                                            <option value="5">AGUARDANDO</option>
                                            <option value="6">ANALISE</option>
                                            <option value="7">URGENTE</option>

                                        </select>
                                    </label>
                                </div>

                               
                            </div>
                        </div>
                        <a type="button" id="btn-buscar" class="btn btn-primary">Buscar</a>

                        <div class="p-6 ">
                            <div class="border border-2 responsive" id="table-autorizacao">

                            </div>
                        </div>

                        <!-- table -->
                        <div id="table-exams">
                        </div>


                        <!-- endtable -->
                    </div>

                </div>

            </div>
        </form>


    </body>
@else
    <script>
        window.location.href = "{{ url('/') }}"
    </script>
@endif


<script>
    $(document).ready(function() {
        $("#btn-buscar").click(function() {
            const url = "{{ route('showtableexams') }}";
            status = $("#status").val();
            data_inicial = $("#data_inicial").val();
            data_final = $("#data_final").val();
            $.ajax({
                url: url,
                data: {
                    'status': status,
                    'data_inicial' : data_inicial,
                    'data_final' : data_final
                },
                success: function(data) {
                    $("#table-exams").html(data);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>