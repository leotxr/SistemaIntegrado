<div>

    @php
        $perguntas = ['Omniscan', 'Soro Fisiológico', 'Água para Injeção', 'Buscopan', 'Soro Retal', 'Gel vaginal'];
        $i = 0;
    @endphp

    <div class="relative overflow-x-auto border border-dashed sm:rounded-lg w-full">
        <table class=" text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Contraste Gadolíneo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantidade
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Dispositivo Intravenoso
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Membro da Punção
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Via
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Lote
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Validade
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm">
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
                            <input type="text" name="quant[{{ $i }}]"
                                class="input input-bordered w-full mt-2" value="" />
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="text" name="disp[{{ $i }}]"
                                class="input input-bordered  w-full mt-2" value="" />
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="text" name="membro[{{ $i }}]"
                                class="input input-bordered w-full mt-2" value="" />
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="text" name="via[{{ $i }}]"
                                class="input input-bordered w-full mt-2" value="" />
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="text" name="lote[{{ $i }}]"
                                class="input input-bordered w-full mt-2" value="" />
                        </th>
                        <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <input type="text" name="validade[{{ $i }}]"
                            class="input input-bordered w-full mt-2" value="" />
                    </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @php
    $perguntas2 = ['Houve extravasamento?', 'Houve reação alérgica?', 'Administrado outra medicação?'];
    $i = 0;
@endphp

    <div>
        <div class="relative overflow-x-auto border border-dashed sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                @foreach ($perguntas2 as $pergunta)
                @php
                    $i++;
                @endphp
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            {{$pergunta}}
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
                    <tr>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-pre-line dark:text-white">
                            
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="radio" name="radio-[{{$i}}]" class="radio mx-2" />
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="radio" name="radio-[{{$i}}]" class="radio mx-2" checked />
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="text" name="observacao-[{{$i}}]"
                                class="input input-bordered input-xs w-full max-w-xs mt-2" value="" />
                        </th>
                    </tr>
                    
                </tbody>
                @endforeach
            </table>
        </div>
    
    </div>

</div>
