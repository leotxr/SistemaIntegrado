<div class="h-full overflow-x-auto">
    <table class="table table-compact">
        <!-- head -->
        <thead>
            <tr>
                <th>Ações</th>
                <th>Data do Exame</th>
                <th>Paciente</th>
                <th>Procedimento</th>
                <th>Contraste</th>
            </tr>
        </thead>
        <tbody>
            @empty($terms)
            {{ 'Não existem dados para serem mostrados.' }}
            @endisset
            @isset($terms)
            @foreach ($terms as $term)
            <tr>
                <th class="dropdown dropdown-bottom">
                    <label tabindex="0" class="m-1 btn btn-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </label>
                    <ul tabindex="0" class="absolute inline-block p-2 shadow dropdown-content menu bg-base-100 rounded-box w-52">
                        @if($term->signed != 1)
                        <li>
                            <form method="POST" action="{{ route('create.term-signature', ['id' => $term->id]) }}">
                                @csrf
                                <button type="submit">Assinar triagem</button>
                            </form>
                        </li>
                        @endif

                        <li>
                            <form method="POST" action="{{ route('create.term-file', ['id' => $term->id]) }}">
                                @csrf
                                <button type="submit">Adicionar Arquivos</button>
                            </form>
                        </li>
                        
                        <li> <a href="{{ route('create.contraste-ressonancia', ['id'=>$term->id]) }}">Contraste</a></li>

                        <li>
                            <form method="POST" action="">
                                @csrf
                                <button type="submit">Ver/Editar triagem</button>
                            </form>
                        </li>
                    </ul>
                </th>
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
            </tr>
            @endforeach
            @endisset
            {{ $terms->links() }}
        </tbody>
    </table>


</div>