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
                <th>Status</th>
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
                    <td>{{ $protocols->exam_status ?? '?' }}</td>
                    <td class="flex">
                        <!--<label id="btn-edit" data-value="{{ $protocols->protocol_id }}" for="my-modal-6">Editar</label>-->
                        <a href="{{ url("autorizacao/$protocols->protocol_id/edit") }}" class="btn btn-primary mx-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                        <form action="{{ url('/destroy_exam/' . $protocols->id) }}" method="post">
                            {{ method_field('DELETE') }}
                            @csrf
                            <button type="submit" for="my-modal-6" class="btn btn-error mx-2 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </form>

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
