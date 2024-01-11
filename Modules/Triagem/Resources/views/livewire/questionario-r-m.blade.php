<div>

    <div class="overflow-x-auto border border-dashed sm:rounded-lg">
        <x-table>
            <x-slot:head>
                <x-table.heading scope="col" class="px-6 py-3">
                    Questionário
                </x-table.heading>
                <x-table.heading scope="col" class="px-6 py-3">
                    Sim
                </x-table.heading>
                <x-table.heading scope="col" class="px-6 py-3">
                    Não
                </x-table.heading>
                <x-table.heading scope="col" class="px-6 py-3">
                    Observação
                </x-table.heading>
            </x-slot:head>

            <x-slot:body>
                @php
                    $i = 0;
                @endphp
                @foreach ($perguntas as $pergunta)
                    {{$i++}}
                    <x-table.row>
                        <x-table.cell scope="row" name="pergunta">
                            <input type="pergunta" name="pergunta[{{$i}}]" class="w-full input" readonly
                                   value="{{ $pergunta->description }}"/>
                        </x-table.cell>
                        <x-table.cell scope="row">
                            <input type="radio" name="radio[{{$i}}]" class="mx-2 radio" value="Sim"/>
                        </x-table.cell>
                        <x-table.cell scope="row">
                            <input type="radio" name="radio[{{$i}}]" class="mx-2 radio" value="Não" checked/>
                        </x-table.cell>
                        <x-table.cell scope="row">
                            <input type="text" name="observacao[{{$i}}]"
                                   class="w-full mt-2 input input-bordered" value=""/>
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot:body>
        </x-table>
        <div class="p-5 col-12">
            <div>
                <h2 class="text-xl font-extrabold dark:text-white p-2">Observação da Triagem</h2>
                <x-text-area></x-text-area>
            </div>
        </div>
    </div>

</div>
