<div>

    @php
        $perguntas = ['Omnipaque', 'Soro Fisiológico', 'Contraste Retal'];
        $i = 0;
    @endphp

    <div class="relative w-full overflow-x-auto border border-dashed sm:rounded-lg">
        <table class="text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Contraste Iodado
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
                                class="w-full mt-2 input input-bordered" value="" />
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="text" name="disp[{{ $i }}]"
                                class="w-full mt-2 input input-bordered" value="" />
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="text" name="membro[{{ $i }}]"
                                class="w-full mt-2 input input-bordered" value="" />
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="text" name="via[{{ $i }}]"
                                class="w-full mt-2 input input-bordered" value="" />
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="text" name="lote[{{ $i }}]"
                                class="w-full mt-2 input input-bordered" value="" />
                        </th>
                        <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <input type="text" name="validade[{{ $i }}]"
                            class="w-full mt-2 input input-bordered" value="" />
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
                            <input type="radio" name="radio-[{{$i}}]" class="mx-2 radio" />
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="radio" name="radio-[{{$i}}]" class="mx-2 radio" checked />
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="text" name="observacao-[{{$i}}]"
                                class="w-full max-w-xs mt-2 input input-bordered input-xs" value="" />
                        </th>
                    </tr>
                    
                </tbody>
                @endforeach
            </table>
        </div>
    
    </div>

</div>
