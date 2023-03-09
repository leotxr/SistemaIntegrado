<div>
    <div class="p-2">
        <p class="text-xl font-bold">Contraste gadolíneo</p>
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
                <label class="font-bold" for="quant[{{ $i }}]">Quantidade</label>
                <input type="number" name="quant[{{ $i }}]"
                    class="input input-bordered w-full max-w-xs text-xs" />
            </div>

            <div class="border-solid border-2">
                <label class="font-bold" for="disp[{{ $i }}]">Disp.Intr.</label>
                <input type="text" name="disp[{{ $i }}]"
                    class="input input-bordered w-full max-w-sm text-xs" />
            </div>

            <div class="border-solid border-2">
                <label class="font-bold" for="membro[{{ $i }}]">M. Punção</label>
                <input type="text" name="membro[{{ $i }}]"
                    class="input input-bordered w-full max-w-sm text-xs" />
            </div>

            <div class="border-solid border-2">
                <label class="font-bold" for="via[{{ $i }}]">Via</label>
                <input type="text" name="via[{{ $i }}]"
                    class="input input-bordered w-full max-w-sm text-xs" />
            </div>

            <div class="border-solid border-2">
                <label class="font-bold" for="lote[{{ $i }}]">Lote</label>
                <input type="text" name="lote[{{ $i }}]"
                    class="input input-bordered w-full max-w-sm text-xs" />
            </div>

            <div class="border-solid border-2">
                <label class="font-bold" for="validade[{{ $i }}]">Validade</label>
                <input type="date" name="validade[{{ $i }}]"
                    class="input input-bordered w-full max-w-sm text-xs" />
            </div>

        </div>
    @endforeach
    <div id="assinaturas">

    </div>
</div>
