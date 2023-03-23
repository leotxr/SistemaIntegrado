<div class="overflow-y-auto h-96">
    <table class="table table-compact">
        <!-- head -->
        <thead>
            <tr>
                <th>ID do paciente</th>
                <th>Data do Exame</th>
                <th>Paciente</th>
                <th>Procedimento</th>
                <th>Contraste</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @empty($terms)
                {{ 'Não existem dados para serem mostrados.' }}
            @endisset
            @isset($terms)
                @foreach ($terms as $term)
                    <tr>
                        <th>{{ $term->patient_id }}</th>
                        <td>{{ $term->exam_date }}</td>
                        <td>{{ $term->patient_name }}</td>
                        <td>{{ $term->proced }}</td>
                        <td>
                            @if ($term->contrast == 1)
                                Sim
                            @else
                                Não
                            @endif
                        </td>
                        <th class="flex">
                            <!--<label id="btn-edit" data-value="{{ $term->id }}" for="my-modal-6">Editar</label>-->
                            <a href="{{ url("triagem/terms/$term->id") }}" class="btn btn-success mx-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </a>

                        </th>
                    </tr>
                @endforeach
            @endisset
        </tbody>
    </table>
</div>
