@extends('helpdesk::layouts.master')
@section('content')
    <div class="mt-4 shadow-sm sm:m-4">
        <div class="max-w-full justify-items-center">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <form>
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
                                            <input type="date" id="start_date"
                                                class="border-gray-300 input dark:bg-gray-800 dark:text-white">
                                        </div>
                                        <div>
                                            <label for="final_date"
                                                class="text-sm font-light text-gray-900 label dark:text-gray-50">Data
                                                Final</label>
                                            <input type="date" id="end_date"
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
                        <div>
                            <table id="extraServicesTable" class="display">
                                <thead>
                                    <tr>
                                        <td>
                                            ID
                                        </td>
                                        <td>
                                            Data
                                        </td>
                                        <td>
                                            Titulo
                                        </td>
                                        <td>
                                            Descrição
                                        </td>
                                        <td>
                                            Solicitante
                                        </td>
                                        <td>
                                            Setor
                                        </td>
                                        <td>
                                            Item
                                        </td>
                                        <td>
                                            Ação
                                        </td>
                                        <td>
                                            Status
                                        </td>
                                        <td>
                                            Ticket TI
                                        </td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $("#submit").click(function() {
            const url = "{{ route('helpdesk.reports.extra-services.gerar') }}";
            start_date = $("#start_date").val();
            end_date = $("#end_date").val();

            $.ajax({
                url: url,
                data: {
                    'start_date': start_date,
                    'end_date': end_date
                },
                success: function(data) {
                    if ($.fn.DataTable.isDataTable("#extraServicesTable")) {
                        // Se a tabela já existe, destrói e recria
                        $("#extraServicesTable").DataTable().clear().destroy();
                    }

                    $("#extraServicesTable").DataTable({
                        data: data, // Usa os dados retornados da API
                        columns: [{
                                data: "id"
                            }, // O nome da chave no JSON deve corresponder
                            {
                                data: "created_at"
                            },
                            {
                                data: "title"
                            },
                            {
                                data: "description"
                            },
                            {
                                data: "requester_id"
                            },
                            {
                                data: "sector"
                            },
                            {
                                data: "item"
                            },
                            {
                                data: "action"
                            },
                            {
                                data: "status_id"
                            },
                            {
                                data: "is_ticket"
                            }
                        ],
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/Portuguese-Brasil.json"
                        }
                    });
                }

            });
        });
    </script>
@endsection
