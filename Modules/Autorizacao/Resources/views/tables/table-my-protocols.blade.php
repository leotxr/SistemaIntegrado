<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
</head>
<div class="overflow-x-auto overflox-y-auto">
    <table id="table" class="w-full mx-auto table-zebra overflow-hidden bg-white divide-y divide-gray-300 rounded-lg">
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
            @foreach ($result as $protocols)
                <tr>
                    <th>{{ $protocols->exam_date }}</th>
                    <td>{{ $protocols->paciente_name ?? '?' }}</td>
                    <td>{{ $protocols->name ?? '?' }}</td>
                    <td>{{ $protocols->convenio ?? '?' }}</td>
                    <td>{{ $protocols->created_by ?? '?' }}</td>
                    <td class="flex">
                        <!--<label id="btn-edit" data-value="{{ $protocols->protocol_id }}" for="my-modal-6">Editar</label>-->
                        <a href="{{ url("autorizacao/$protocols->protocol_id") }}" class="btn btn-primary mx-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>

                        </a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>




<script>
    $(document).ready(function() {
        $("#btn-edit").click(function() {
            var id = $(this).attr('data-value');
            $.ajax({
                url: 'autorizacao/' + id + '/edit',
                success: function(data) {
                    alert(id);
                    //$("#edit-screen").html(data);
                }
            });
        });

        $('#table').DataTable();
    });
</script>
