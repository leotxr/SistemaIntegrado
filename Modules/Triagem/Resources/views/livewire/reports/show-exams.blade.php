<div class="justify-center">
    <div class="p-2 bg-white shadow sm:p-4 dark:bg-gray-800 sm:rounded-lg">
        <x-accordion>
            <x-slot name="title">
                <div class="text-gray-900 dark:text-white font-bold justify-start flex mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                    </svg>
                    <h1>Filtros<h1>
                </div>
            </x-slot>
            <x-slot name="content">
                <div class="max-w-full">
                    <div class="grid grid-cols-2 sm:grid-cols-6 gap-4 content-center">
                        <div>
                            <label for="initial_date"
                                class="label text-gray-900 dark:text-gray-50 font-light text-sm">Data
                                inicial</label>
                            <input type="date" wire:model.defer='initial_date' id="initial_date"
                                class="input border-gray-300">
                        </div>
                        <div>
                            <label for="final_date"
                                class="label text-gray-900 dark:text-gray-50 font-light text-sm">Data Final</label>
                            <input type="date" wire:model.defer='final_date' id="final_date"
                                class="input border-gray-300">
                        </div>
                        <div>
                            <label for="filter"
                                class="label text-gray-900 dark:text-gray-50 font-light text-sm">Filtros</label>
                            <x-primary-button id="filter" wire:click='searchFilters()'>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                                </svg>
                                <span>Filtros<span>
                            </x-primary-button>
                        </div>
                        <div>
                            <label for="submit" class="label text-gray-900 dark:text-gray-50 font-light text-sm">Gerar
                                relatório</label>
                            <x-primary-button id="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                                <span>Buscar<span>
                            </x-primary-button>
                        </div>
                        <div>
                            <label for="excel" class="text-sm font-light text-gray-900 label dark:text-gray-50">Gerar
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
    <div>
        @include('triagem::painel.tables.table-report')
    </div>


    {{-- MODAL --}}
    <x-modal.dialog wire:model.defer="modalFilters">
        <x-slot name="title">
            Filtros de pesquisa
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="border-2 p-4">
                    <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Selecionar Usuários</h3>
                    @foreach ($users as $user)
                        <ul
                            class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input type="checkbox"
                                        class="user-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        value="{{ $user->id }}" id="user-{{ $user->id }}"checked>
                                    <label for="user-{{ $user->id }}"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ $user->name }}
                                    </label>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                </div>
                <div class="border-2 p-4">
                    <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Selecionar Setores</h3>
                    @foreach ($sectors as $sector)
                        <ul
                            class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input id="sector-{{ $sector->id }}" type="checkbox" name="sec[]"
                                        value="{{ $sector->id }}" checked
                                        class="sector-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="sector-{{ $sector->id }}"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $sector->name }}</label>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>
        </x-slot>


    </x-modal.dialog>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Preenche o array com os usuários marcados por padrão
            let usuariosSelecionados = Array.from(document.querySelectorAll('.user-checkbox:checked')).map(cb => cb
                .value);

            let setoresSelecionados = Array.from(document.querySelectorAll('.sector-checkbox:checked')).map(cb => cb
                .value);

            console.log("Usuarios selecionados:", usuariosSelecionados);
            console.log("Setores selecionados:", setoresSelecionados);

            // ATUALIZA OS USUARIOS SELECIONADOS AO CLICAR EM CADA CHECKBOX
            document.querySelectorAll('.user-checkbox').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const userId = this.value;

                    if (this.checked) {
                        if (!usuariosSelecionados.includes(userId)) {
                            usuariosSelecionados.push(userId);
                        }
                    } else {
                        usuariosSelecionados = usuariosSelecionados.filter(id => id !== userId);
                    }

                    console.log("Selecionados:", usuariosSelecionados);
                });
            });

            // ATUALIZA OS SETORES SELECIONADOS AO CLICAR EM CADA CHECKBOX
            document.querySelectorAll('.sector-checkbox').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const sectorId = this.value;

                    if (this.checked) {
                        if (!setoresSelecionados.includes(sectorId)) {
                            setoresSelecionados.push(sectorId);
                        }
                    } else {
                        setoresSelecionados = setoresSelecionados.filter(id => id !== sectorId);
                    }

                    console.log("Selecionados:", setoresSelecionados);
                });
            });

            $('#submit').click(function() {
                var payload = {
                    start_date: $("#initial_date").val(),
                    end_date: $("#final_date").val(),
                    nurses: usuariosSelecionados,
                    sectors: setoresSelecionados
                }

                console.log(payload);

                $.ajax({
                    url: '/api/triagem/relatorios/triagens-por-data',
                    data: payload,
                    method: 'POST',
                    success: function(response) {
                        $('#tableTriagens').DataTable().destroy();
                        $('#tableTriagens').empty(); // Remove conteúdo antigo da tabela
                        construirTableTriagens(response.data);
                    },
                    error: function(xhr, status, error) {
                        $('#resultado').html('Ocorreu um erro: ' + error);
                    }
                });
            });

            $('#excel').click(function() {
                let dataInicio = $("#initial_date").val();
                let dataFim = $("#final_date").val();

                // Arrays já definidos no seu script
                let usuariosSelecionados = Array.from(document.querySelectorAll('.user-checkbox:checked'))
                    .map(cb => cb.value);
                let setoresSelecionados = Array.from(document.querySelectorAll('.sector-checkbox:checked'))
                    .map(cb => cb.value);

                // Cria o formulário
                let form = document.createElement("form");
                form.method = "POST";
                form.action = "/api/triagem/relatorios/excel/triagens-por-data";
                form.target = "_blank"; // para abrir o download em nova aba (opcional)

                // Campos simples
                let startInput = document.createElement("input");
                startInput.type = "hidden";
                startInput.name = "start_date";
                startInput.value = dataInicio;
                form.appendChild(startInput);

                let endInput = document.createElement("input");
                endInput.type = "hidden";
                endInput.name = "end_date";
                endInput.value = dataFim;
                form.appendChild(endInput);

                // Campos de arrays
                usuariosSelecionados.forEach(id => {
                    let input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "nurses[]";
                    input.value = id;
                    form.appendChild(input);
                });

                setoresSelecionados.forEach(id => {
                    let input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "sectors[]";
                    input.value = id;
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);
            });

            function construirTableTriagens(dados) {
                $('#tableTriagens').DataTable({
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
                            $(td).addClass('max-w-[250px] truncate overflow-hidden');
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
                            data: 'DATA_EXAME',
                            defaultContent: ''
                        },
                        {
                            data: 'PACIENTE',
                            defaultContent: ''
                        },
                        {
                            data: 'EXAME',
                            defaultContent: ''
                        },
                        {
                            data: 'USUARIO',
                            defaultContent: ''
                        },
                        {
                            data: 'INICIO',
                            defaultContent: ''
                        },
                        {
                            data: 'FIM',
                            defaultContent: ''
                        },
                        {
                            data: 'TEMPO',
                            defaultContent: ''
                        }
                    ]
                });
            }
        });
    </script>

</div>
