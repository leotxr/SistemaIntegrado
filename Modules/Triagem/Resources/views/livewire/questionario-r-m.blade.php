<div>

    @php
        $perguntas = ['Usa marca passo?', 'Possui clipe metálico para aneurisma?', 'Realizou algum exame com contraste recentemente?', 'Usa prótese metálica no ouvido, aparelho de surdez ou implante coclear?', 'Possui prótese dentária?', 'Fragmento metálico?', 'Já fez acupuntura?', 'Usa prótese peniana metálica?', 'Está grávida ou com suspeita de gravidez?', 'Está amamentando?', 'É portador de insuficiência renal/faz que tipo de tratamento?', 'Já fez RM com contraste?', 'Teve alguma reação?'];
        $i = 0;
    @endphp

        <div class="relative overflow-x-auto border border-dashed sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Questionario
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Sim
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Não
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Observação
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perguntas as $pergunta)
                    @php
                        $i++;
                    @endphp
                    <tr>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-pre-line dark:text-white">
                            {{ $pergunta }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="radio" name="radio-{{ $i }}" class="radio mx-2" />
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="radio" name="radio-{{ $i }}" class="radio mx-2" checked />
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="text" name="observacao-{{ $i }}"
                                class="input input-bordered input-xs w-full max-w-xs mt-2" value="" />
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
</div>
