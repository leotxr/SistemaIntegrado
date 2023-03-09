
<body>
    @if (auth()->user())
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

                            <div class="overflow-x-auto overflox-y-auto shadow-md">
                                <table id="table"
                                    class="w-full mx-auto table-zebra overflow-hidden bg-white divide-y divide-gray-300 rounded-lg">
                                    <!-- head -->
                                    <thead>
                                        <tr>
                                            <th>Criado</th>
                                            <th>Data</th>
                                            <th>Nome</th>
                                            <th>Exame</th>
                                            <th>Convênio</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($protocols as $protocol)
                                            <tr>
                                                <th>{{$protocol->created_at}}</th>
                                                <th>{{ $protocol->exam_date }}</th>
                                                <td>{{ $protocol->paciente_name ?? '?' }}</td>
                                                <td>{{ $protocol->name ?? '?' }}</td>
                                                <td>{{ $protocol->convenio ?? '?' }}</td>
                                                <td>{{ $protocol->exam_status ?? '?' }}</td>
                                                <td><a href="{{ url("autorizacao/$protocol->protocol_id/edit") }}"
                                                        class="mx-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>

                                                    </a></td>
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
    @else
        <script>
            window.location.href = "{{ url('/') }}"
        </script>
    @endif

</body>

<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>