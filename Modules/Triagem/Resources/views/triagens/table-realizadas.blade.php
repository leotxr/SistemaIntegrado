<div class="overflow-y-auto" id="capture">
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
                            <form method="POST" action="{{ url('triagem/files/create') }}">
                                @csrf
                                <button type="submit" value="{{ $term->id }}" name="btn_term_id" class="btn btn-info mx-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                    </svg>
                                </button>
                            </form>
                            <!--<label id="btn-edit" data-value="{{ $term->id }}" for="my-modal-6">Editar</label>-->
                            <a href="{{ route('create.contraste-ressonancia', ['id'=>$term->id]) }}" class="btn btn-success mx-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-capsule w-6 h-6"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M1.828 8.9 8.9 1.827a4 4 0 1 1 5.657 5.657l-7.07 7.071A4 4 0 1 1 1.827 8.9Zm9.128.771 2.893-2.893a3 3 0 1 0-4.243-4.242L6.713 5.429l4.243 4.242Z" />
                                </svg>
                            </a>
                            <form action="{{ url('triagem/terms/' . $term->id) }}" method="post">
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

                        </th>
                    </tr>
                @endforeach
            @endisset
            {{ $terms->links() }}
        </tbody>
    </table>
</div>
