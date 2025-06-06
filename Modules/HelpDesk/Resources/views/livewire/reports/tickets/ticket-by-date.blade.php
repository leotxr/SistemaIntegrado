<div class="shadow-sm">
    <div class="max-w-full justify-items-center">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4">
                <form wire:submit.prevent='render'>
                    @csrf
                    <div class="p-2 bg-white shadow sm:p-4 dark:bg-gray-800 sm:rounded-lg">
                        <x-accordion>
                            <x-slot name="title">
                                <div class="flex justify-start mx-2 font-bold text-gray-900 dark:text-white">
                                    <x-icon name="filter" class="w-6 h-6"></x-icon>
                                    <h1>Filtros<h1>
                                </div>
                            </x-slot>
                            <x-slot name="content">
                                <div class="max-w-full">
                                    <div class="grid content-center grid-cols-2 gap-4 sm:grid-cols-4">
                                        <div>
                                            <label for="initial_date"
                                                class="text-sm font-light text-gray-900 label dark:text-gray-50">Data
                                                inicial</label>
                                            <input type="date" id="initial_date"
                                                class="border-gray-300 input dark:bg-gray-800 dark:text-white">
                                        </div>
                                        <div>
                                            <label for="final_date"
                                                class="text-sm font-light text-gray-900 label dark:text-gray-50">Data
                                                Final</label>
                                            <input type="date" id="final_date"
                                                class="border-gray-300 input dark:bg-gray-800 dark:text-white">
                                        </div>
                                        <div>
                                            <label for="submit"
                                                class="text-sm font-light text-gray-900 label dark:text-gray-50">Gerar
                                                relatório</label>
                                            <x-primary-button id="submit" type="button">
                                                <x-icon name="search" class="w-6 h-6"></x-icon>
                                                <span>Buscar<span>
                                            </x-primary-button>

                                        </div>
                                        <div>
                                            <label for="excel"
                                                class="text-sm font-light text-gray-900 label dark:text-gray-50">Gerar
                                                relatório</label>
                                            <x-secondary-button id="excel" type="button">
                                                <x-icon name="document" class="w-6 h-6"></x-icon>
                                                Exportar
                                            </x-secondary-button>
                                        </div>
                                    </div>
                                </div>

                            </x-slot>
                        </x-accordion>

                    </div>
                </form>
                <div class="p-5 text-gray-900 dark:text-white">
                    <table id="tableTickets" class="display table-striped ">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Data</th>
                                <th class="px-4 py-2 w-[250px]">Assunto</th>
                                <th class="px-4 py-2">Solicitante</th>
                                <th class="px-4 py-2">Setor</th>
                                <th class="px-4 py-2">Categoria</th>
                                <th class="px-4 py-2">Sub-Categoria</th>
                                <th class="px-4 py-2">Prioridade</th>
                                <th class="px-4 py-2">Atendente</th>
                                <th class="px-4 py-2">Tempo</th>
                                <th class="px-4 py-2">Espera</th>
                            </tr>
                        </thead>
                        <tbody class="dark:color-white color-black">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#submit').click(function() {
            $.ajax({
                url: '/api/chamados/relatorios/tickets-por-data',
                data: {
                    initial_date: $("#initial_date").val(),
                    final_date: $("#final_date").val()
                },
                method: 'GET',
                success: function(response) {
                    construirTableTickets(response.data);
                },
                error: function(xhr, status, error) {
                    $('#resultado').html('Ocorreu um erro: ' + error);
                }
            });
        });

        $('#excel').click(function() {
            var dataInicio = $("#initial_date").val();
            var dataFim = $("#final_date").val();

            window.location.href = '/api/chamados/relatorios/excel/tickets-por-data?initial_date=' + dataInicio + '&final_date=' + dataFim + '&type=export';
        });

        function construirTableTickets(dados) {
            $('#tableTickets').DataTable({
                data: dados,
                destroy: true,
                pageLength: 20,
                lengthMenu: [20, 40, 60, 100],
                ordering: true,
                searching: false,
                responsive: true,
                columnDefs: [{
                    targets: 2, // índice da coluna "Assunto"
                    createdCell: function(td) {
                        $(td).addClass('max-w-[250px] truncate whitespace-nowrap overflow-hidden');
                    }
                }],
                language: {
                    lengthMenu: 'Mostrar _MENU_ registros por página',
                    zeroRecords: 'Nenhum registro encontrado',
                    info: 'Mostrando _START_ a _END_ de _TOTAL_ registros',
                    infoEmpty: 'Nenhum registro disponível',
                    infoFiltered: '(filtrado de _MAX_ registros totais)',
                    search: 'Buscar:',
                    paginate: {
                        first: '«',
                        last: '»',
                        next: '›',
                        previous: '‹'
                    }
                },
                columns: [{
                        data: 'TICKET_ID',
                        defaultContent: ''
                    },
                    {
                        data: 'DATA_TICKET',
                        defaultContent: ''
                    },
                    {
                        data: 'DESCRICAO',
                        defaultContent: ''
                    },
                    {
                        data: 'SOLICITANTE',
                        defaultContent: ''
                    },
                    {
                        data: 'SETOR',
                        defaultContent: ''
                    },
                    {
                        data: 'CATEGORIA',
                        defaultContent: ''
                    },
                    {
                        data: 'SUB_CATEGORIA',
                        defaultContent: ''
                    },
                    {
                        data: 'PRIORIDADE',
                        defaultContent: ''
                    },
                    {
                        data: 'TI',
                        defaultContent: ''
                    },
                    {
                        data: 'TEMPO_TOTAL',
                        defaultContent: ''
                    },
                    {
                        data: 'ESPERA',
                        defaultContent: ''
                    }
                ]
            });
        }
    </script>

</div>
