<head>
    @livewireStyles
</head>

<body>
    @livewireScripts
    <livewire:triagem::layouts.app />
    <div id="capture" class="bg-white">
        <div name="header" class="text-center p-5">
            <h2 class="font-semibold text-2xl leading-tight">
                {{ __('Termo de Consentimento para Ressonância Magnética') }}
            </h2>
        </div>
        <form method="post" action="{{ url('terms') }}">
            @csrf
            <div id="termo" class="p-5 shadow-md rounded-md bg-white max-w-screen-xl border border-2">
                <div id="print-termo-contraste">
                    <div class="w-lg bg-white rounded-md grid grid-cols-2 sm:grid-cols-3">
                        <div>
                            <label class="label font-bold" for="nome">
                                Nome:
                            </label>
                            <input type="text" name="nome" id="nome" class="input w-full max-w-md text-md"
                                readonly value=" {{ $paciente->NOME }} " />
                            <input type="text" name="pacienteid" id="pacienteid"
                                class="input w-full max-w-md text-md hidden" readonly
                                value=" {{ $paciente->PACIENTEID }} " />

                        </div>
                        <div>
                            <label class="label font-bold" for="nome">
                                Data de Nascimento:
                            </label>
                            <input type="text" name="" id=""
                                class="input w-full max-w-md text-md hidden"
                                readonly />{{ date('d/m/Y', strtotime($paciente->DATANASC)) }}

                            <input type="text" name="nascimento" id="nascimento"
                                class="input w-full max-w-md text-md hidden" readonly
                                value=" {{ $paciente->DATANASC }} " />
                        </div>

                        <div>
                            <label class="label font-bold" for="nome">
                                Início da Triagem:
                            </label>
                            <input type="text" name="start" id="start" class="input w-full max-w-xs text-md"
                                readonly value="{{ $start }}" />
                        </div>



                    </div>

                    <div id="termo">
                        <livewire:triagem::components.termo />
                    </div>

                    <div id="questionario">
                        <livewire:triagem::components.questionario />
                    </div>

                    <div id="assinatura" class="grid grid-cols-3 sm:grid-cols-4 p-5 bg-white">
                        <div>


                            <!-- CLONE DA ASSINATURA -->
                            <div id="parent2" class="parent text-center">
                                <img src="" id="imgclone" name="assinatura" class="child">
                                <input type="text" value="" id="dataurl" class="hidden" name="dataurl"
                                    required />
                                <div>
                                    Assinatura do Titular/Responsável
                                </div>
                            </div>
                            <!-- FIM CLONE ASSINATURA -->

                        </div>

                        <div>
                            <!-- The button to open modal -->
                            <label for="my-modal-6" id="openmodal" class="btn btn-outline btn-primary rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </label>


                        </div>

                        <div>
                            <label class="font-bold" for="nome">
                                Data do exame:
                            </label>
                            <input type="text" name="exam_date" id="exam_date"
                                class="input w-full max-w-md text-md hidden"
                                readonly />{{ date('d/m/Y', strtotime($paciente->DATA)) }}

                            <input type="text" name="exam_date" id="exam_date"
                                class="input w-full max-w-md text-md hidden" readonly value=" {{ $paciente->DATA }} " />
                        </div>

                        <div class="grid justify-items-end">
                            <a type="button" href="#termo-telelaudo" class="btn btn-success">Próximo</a>
                        </div>

                    </div>
                </div>

                <div id="print-termo-telelaudo">
                    <!-- TERMO TELELAUDO -->
                    <div id="termo-telelaudo" class="py-6 border border-2">
                        <livewire:triagem::components.termo-telelaudo />
                    </div>

                    <div id="assinatura" class="grid grid-cols-3 sm:grid-cols-4 p-5 bg-white">
                        <div>


                            <!-- CLONE DA ASSINATURA -->
                            <div id="parent2" class="parent text-center">
                                <img src="" id="imgclone2" name="assinatura" class="child">
                                <input type="text" value="" id="dataurltele" class="hidden" name="dataurltele"
                                    required />
                                <div>
                                    Assinatura do Titular/Responsável
                                </div>
                            </div>
                            <!-- FIM CLONE ASSINATURA -->

                        </div>

                        <div>
                            <!-- The button to open modal -->
                            <label for="my-modal-7" id="openmodal2" class="btn btn-outline btn-primary rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </label>


                        </div>

                        <div>
                            <label class="font-bold" for="nome">
                                Data do exame:
                            </label>
                            <input type="text" name="exam_date" id="exam_date"
                                class="input w-full max-w-md text-md hidden"
                                readonly />{{ date('d/m/Y', strtotime($paciente->DATA)) }}

                            <input type="text" name="exam_date" id="exam_date"
                                class="input w-full max-w-md text-md hidden" readonly
                                value=" {{ $paciente->DATA }} " />
                        </div>

                        <div class="grid justify-items-end">
                            <button wire:click="submit" type="submit" class="btn btn-primary rounded-sm">Enviar</button>
                        </div>

                    </div>
                </div>


            </div>

        </form>
    </div>

    <div wire:loading>
        Processando
    </div>
</body>
<!-- MODAL -->

<!-- Put this part before </body> tag -->
<input type="checkbox" id="my-modal-6" class="modal-toggle" />
<div class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
        <livewire:triagem::components.info-paciente />

    </div>
</div>
<!-- FIM MODAL -->

<!--modal assinatura telelaudo -->

<input type="checkbox" id="my-modal-7" class="modal-toggle" />
<div class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
        <livewire:triagem::components.sign-telelaudo />

    </div>
</div>


<script>
    $(document).ready(function() {
        $("#openmodal").click(function() {
            $("body").toggleClass("overflow-hidden");
        });

        $("#openmodal2").click(function() {
            $("body").toggleClass("overflow-hidden");
        })
    });
</script>
