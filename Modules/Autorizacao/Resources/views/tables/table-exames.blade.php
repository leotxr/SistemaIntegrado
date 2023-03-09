
<div class="overflow-x-auto">
    <a type="button" class="btn btn-success gap-2 mb-5" id="export_table">
        Excel
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
        </svg>
    </a>
    <table id="table" class="table table-compact w-full">
        <thead>
            <tr>

                <th>Data do Exame</th>
                <th>Paciente</th>
                <th>Procedimento</th>
                <th>Usuário</th>
                <th>Status</th>
                <th>Acoes</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($result as $r)
                <tr>
                    <td>{{ $r->exam_date }}</td>
                    <td>{{ $r->paciente_name }}</td>
                    <td>{{ $r->name }}</td>
                    <td>{{ $r->created_by }}</td>
                    <td>{{ $r->exam_status }}</td>
                    <td><a href="{{ url("autorizacao/$r->protocol_id/edit") }}"
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

<script>
    function html_table_to_excel(type) {
        var data = document.getElementById('table');

        var file = XLSX.utils.table_to_book(data, {
            sheet: "sheet1"
        });

        XLSX.write(file, {
            bookType: type,
            bookSST: true,
            type: 'base64'
        });
        const date = new Date();
        XLSX.writeFile(file, 'relatorio_setores_' + date.toDateString() + '.' + type);
    }

    const export_button = document.getElementById('export_table');

    export_button.addEventListener('click', () => {
        html_table_to_excel('xlsx');
    });
</script>
