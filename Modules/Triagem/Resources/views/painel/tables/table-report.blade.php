<div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Data do exame
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Paciente
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Procedimento
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Enfermeira
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Início Triagem
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fim Triagem
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tempo triagem
                    </th>
                </tr>
            </thead>
            {{ $triagens->links() }}
            <tbody>
                @foreach($triagens as $triagem)
                @php
                $enfermeira = $triagem->find($triagem->id)->relUserTerm;
                @endphp
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$triagem->exam_date}}
                    </th>
                    <td class="px-6 py-4">
                        {{$triagem->patient_name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$triagem->proced}}
                    </td>
                    <td class="px-6 py-4">
                        {{$enfermeira->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$triagem->start_hour}}
                    </td>
                    <td class="px-6 py-4">
                        {{$triagem->final_hour}}
                    </td>
                    <td class="px-6 py-4">
                        @if($triagem->final_hour)
                        @php
                        $tempo = gmdate('H:i:s', strtotime( $triagem->final_hour ) - strtotime( $triagem->start_hour )
                        );
                        @endphp
                        {{$tempo}}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $triagens->links() }}
    </div>

</div>