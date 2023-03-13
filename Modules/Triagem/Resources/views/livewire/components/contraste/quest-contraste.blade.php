<div>
    <div class="grid grid-cols-5 sm:grid-cols-7 gap-2 content-center  text-center p-2">
        <label for="pergunta" class="text-sm font-bold border border-2">Contraste Gadolíneo</label>
        <div class="text-md font-bold border border-2">Quantidade</div>
        <div class="text-md font-bold border border-2">Dispositivo Intravenoso</div>
        <div class="text-md font-bold border border-2">Membro da punção</div>
        <div class="text-md font-bold border border-2">Via</div>
        <div class="text-md font-bold border border-2">Lote</div>
        <div class="text-md font-bold border border-2">Validade</div>
    </div>
    @php
        $perguntas = ['Omniscan', 'Soro Fisiológico', 'Água para Injeção', 'Buscopan', 'Soro Retal', 'Gel vaginal'];
        $i = 0;
    @endphp

    @foreach ($perguntas as $pergunta)
        @php
            $i++;
        @endphp
        <div class="p-2 grid grid-cols-5 sm:grid-cols-7 gap-2 content-center border border-2 text-xs">
            <div class="">
                <label class="font-bold">
                    {{ $pergunta }}
                </label>
            </div>

            <div class="border-solid border-2">

                <input type="number" name="quant[{{ $i }}]"
                    class="input input-bordered w-sm max-w-full text-xs" />
            </div>

            <div class="border-solid border-2">

                <input type="text" name="disp[{{ $i }}]"
                    class="input input-bordered w-sm max-w-full  text-xs" />
            </div>

            <div class="border-solid border-2">

                <input type="text" name="membro[{{ $i }}]"
                    class="input input-bordered w-sm max-w-full  text-xs" />
            </div>

            <div class="border-solid border-2">

                <input type="text" name="via[{{ $i }}]"
                    class="input input-bordered w-sm max-w-full  text-xs" />
            </div>

            <div class="border-solid border-2">

                <input type="text" name="lote[{{ $i }}]"
                    class="input input-bordered w-sm max-w-full  text-xs" />
            </div>

            <div class="border-solid border-2">

                <input type="date" name="validade[{{ $i }}]"
                    class="input input-bordered w-sm max-w-full sm:w-full text-xs" />
            </div>

        </div>
    @endforeach
    <div>
        <div class="max-w-full border border-1">
            <div class="grid grid-cols-4 sm:grid-cols-4 gap-4">
                <div>
                    <label class="label font-bold">Houve extravasamento?</label>
                </div>

                <div class="border border-1">
                    <label for="radio-1" class="label font-bold">
                        <span class="label-text">Sim</span>
                        <input type="radio" name="radio-1" class="radio" />
                    </label>
                </div>

                <div class="border border-1">
                    <label for="radio-1" class="label font-bold">
                        <span class="label-text">Não</span>
                        <input type="radio" name="radio-1" class="radio" checked />
                    </label>
                </div>

                <div class="border border-1">
                    <label for="observacao1" class="label font-bold">
                        <input type="text" id="observacao1" class="input input-bordered w-full text-xs" />
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-4 sm:grid-cols-4 gap-4">
                <div>
                    <label class="label font-bold">Houve reação alérgica?</label>
                </div>

                <div class="border border-1">
                    <label for="radio-1" class="label font-bold">
                        <span class="label-text">Sim</span>
                        <input type="radio" name="radio-2" class="radio" />
                    </label>
                </div>

                <div class="border border-1">
                    <label for="radio-1" class="label font-bold">
                        <span class="label-text">Não</span>
                        <input type="radio" name="radio-2" class="radio" checked />
                    </label>
                </div>

                <div class="border border-1">
                    <label for="observacao1" class="label font-bold">
                        <input type="text" id="observacao1" class="input input-bordered w-full text-xs" />
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-4 sm:grid-cols-4 gap-4">
                <div>
                    <label class="label font-bold">Administrado outra medicação?</label>
                </div>

                <div class="border border-1">
                    <label for="radio-1" class="label font-bold">
                        <span class="label-text">Sim</span>
                        <input type="radio" name="radio-3" class="radio" />
                    </label>
                </div>

                <div class="border border-1 justify-items-center">
                    <label for="radio-1" class="label font-bold">
                        <span class="label-text">Não</span>
                        <input type="radio" name="radio-3" class="radio" checked />
                    </label>
                </div>

                <div class="border border-1">
                    <label for="observacao1" class="label font-bold">
                        <input type="text" id="observacao1" class="input input-bordered w-full text-xs" />
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div id="assinaturas">

    </div>
</div>
