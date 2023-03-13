<div>
    <div class="grid grid-cols-4 sm:grid-cols-4 gap-2 content-center  text-center p-2">
        <label for="pergunta" class="text-sm font-bold border border-2">Questionário</label>
        <div class="text-md font-bold border border-2">Sim</div>
        <div class="text-md font-bold border border-2">Não</div>
        <div class="text-md font-bold border border-2">Observação</div>
    </div>
    @php
        $perguntas = ['Usa marca passo?', 'Possui clipe metálico para aneurisma?', 'Realizou algum exame com contraste recentemente?', 'Usa prótese metálica no ouvido, aparelho de surdez ou implante coclear?', 'Possui prótese dentária?', 'Fragmento metálico?', 'Já fez acupuntura?', 'Usa prótese peniana metálica?', 'Está grávida ou com suspeita de gravidez?', 'Está amamentando?', 'É portador de insuficiência renal/faz que tipo de tratamento?', 'Já fez RM com contraste?', 'Teve alguma reação?'];
        $i = 0;
    @endphp

    @foreach ($perguntas as $pergunta)
        @php
            $i++;
        @endphp
        <div class="p-2 grid grid-cols-3 sm:grid-cols-3 gap-2 content-center border border-2 text-sm">
            <div id="pergunta">
                <label class="font-bold">
                    {{ $pergunta }}
                </label>
            </div>
            <div class="radio-group grid grid-cols-2 sm:grid-cols-2 gap-2 justify-items-center">
                <div>

                    <input type="radio" name="radio-{{ $i }}" class="radio mx-2" />
                </div>

                <div>

                    <input type="radio" name="radio-{{ $i }}" class="radio mx-2" checked />
                </div>
            </div>
            <div>

                <input type="text" name="observacao-{{ $i }}"
                    class="input input-bordered input-xs w-full max-w-xs mt-2" value="" />
            </div>
        </div>
    @endforeach
</div>
