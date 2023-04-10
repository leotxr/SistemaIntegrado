<div class="overflow-y-auto h-96">
    <table class="table table-compact">
        <!-- head -->
        <thead>
            <tr>
                <th>Ações</th>
                <th>Hora</th>
                <th>ID</th>
                <th>Nome</th>
                <th>Procedimento</th>
                <th>Status</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($pacientes as $paciente)
                
                    @php
                    
                    $a = $triagens->where('patient_id', $paciente->PACIENTEID)->value('patient_id');

                //echo $a;
                        if ($a == $paciente->PACIENTEID) {
                            $status = 'REALIZADO';
                            $color = 'bg-green-100';
                        } else {
                            $status = 'AGUARDANDO';
                            $color = 'bg-red-100';
                        }
                        
                    @endphp

                    <tr>
                        <th class="{{ $color }}">
                            <form method="GET" action="{{ route('create.ressonancia') }}">
                                @csrf
                                <button type="submit" value="{{ $paciente->PACIENTEID }}" name="paciente_id"
                                    class="btn btn-info mx-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                </button>
                            </form>
                        </th>
                        <th class="{{ $color }}">{{ $paciente->HORA }}</th>
                        <td class="{{ $color }}">{{ $paciente->PACIENTEID }}</td>
                        <td class="{{ $color }}">{{ $paciente->PACIENTE }}</td>
                        <td class="{{ $color }}">{{ $paciente->PROCEDIMENTO }}</td>
                        <td class="{{ $color }}"><strong>{{ $status }}</strong></td>
                    </tr>
                
            @endforeach

        </tbody>
    </table>
</div>
