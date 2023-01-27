<head>
    @livewireStyles
</head>

<body>
    @livewireScripts
    <livewire:autorizacao::layouts.app />
    <div name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Minhas Solicitações') }}
        </h2>
    </div>

    <div class="py-12" id="teste">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    <div class="bg-white shadow-sm font-bold">

                        <head>
                            <link rel="stylesheet" type="text/css"
                                href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

                            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
                        </head>
                        <div class="overflow-x-auto overflox-y-auto">
                            <table id="table"
                                class="w-full mx-auto table-zebra overflow-hidden bg-white divide-y divide-gray-300 rounded-lg">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Nome</th>
                                        <th>Exame</th>
                                        <th>Convênio</th>
                                        <th>Usuário</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($protocols as $protocol)
                                    @php
                                    $exam = $protocol->find($protocol->id)->relExams;
                                    @endphp
                                        <tr>
                                            <th>{{ $protocol->exam_date }}</th>
                                            <td>{{ $protocol->paciente_name ?? '?' }}</td>
                                            <td>{{ $protocol->name ?? '?' }}</td>
                                            <td>{{ $protocol->convenio ?? '?' }}</td>
                                            <td>{{ $protocol->created_by ?? '?' }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>




                        <script>
                            $(document).ready(function() {
                               
                                $('#table').DataTable();
                            });
                        </script>


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



<script></script>
