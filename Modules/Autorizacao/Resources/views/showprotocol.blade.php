<div>
    @if (isset($paciente))
        <form action="{{ url('autorizacao') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="pb-5 flex">

                <div class="col-span-6 sm:col-span-3 w-full">
                    <label for="pacientid" class="block text-sm font-medium text-gray-700">Código do Paciente</label>
                    <input readonly type="text" name="pacienteid" id="pacienteid" autocomplete="pacienteid"
                        value="{{ $pacienteid ?? '' }}" class="input input-bordered input-bordered w-xs max-w-xs" />
                </div>
                <div class="col-span-6 sm:col-span-3 w-full">
                    <label for="name" class="block text-sm font-medium text-gray-700">Paciente</label>
                    <input readonly type="text" name="name" id="name" autocomplete="given-name"
                        value="{{ $paciente ?? '' }}" class="input input-bordered w-full ">
                </div>

            </div>

            <div class="p-2">
                <div tabindex="0" class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-box">
                    <div class="collapse-title text-xl font-medium">
                        Exibir Exames
                    </div>
                    <div class="collapse-content">
                        @foreach ($protocolos as $protocolo)
                            <div class="border-solid border-2 p-3">
                                <div class="col-span-6 sm:col-span-3" hidden>
                                    <label for="protocol_id"
                                        class="block text-sm font-medium text-gray-700">Protocolo</label>
                                    <input readonly type="text" name="protocol_id[]" id="protocol_id"
                                        autocomplete="protocolo" value="{{ $protocolo->HORREQID }}"
                                        class="input input-bordered w-full max-w-xs">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="last-name" class="block text-sm font-medium text-gray-700">Cod.
                                        Exame</label>
                                    @if ($protocolo->CONVENIOID == 4)
                                        <input readonly type="text" name="exam_cod[]" id="exam_cod"
                                            autocomplete="codigo exame" value="{{ $protocolo->CODIGO }}"
                                            class="input input-bordered w-full max-w-lg">
                                    @else
                                        <input readonly type="text" name="exam_cod[]" id="exam_cod"
                                            autocomplete="codigo exame" value="{{ $protocolo->CODTUSS }}"
                                            class="input input-bordered w-full max-w-lg">
                                    @endif

                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="last-name"
                                        class="block text-sm font-medium text-gray-700">Procedimento</label>
                                    <input readonly type="text" name="proced[]" id="proced"
                                        autocomplete="procedimento" value="{{ $protocolo->NOME_PROCEDIMENTO }}"
                                        class="input input-bordered w-full max-w-lg">
                                </div>

                                <div class="col-span-6 sm:col-span-3 pb-5">
                                    <label for="last-name"
                                        class="block text-sm font-medium text-gray-700">Convênio</label>
                                    <input readonly type="text" name="convenio[]" id="convenio"
                                        autocomplete="convenio" value="{{ $protocolo->CONVDESC }}"
                                        class="input input-bordered w-full max-w-xs">
                                </div>

                                <div class="col-span-6 sm:col-span-3 pb-5">
                                    <label for="last-name" class="block text-sm font-medium text-gray-700">Data
                                        Exame</label>
                                    <input readonly type="text" name="exam_date[]" id="exam_date"
                                        autocomplete="data exame" value="{{ $protocolo->DATA }}"
                                        class="input input-bordered w-full max-w-xs">
                                </div>

                                <div class="col-span-6 sm:col-span-3 pb-5">
                                    <label for="status" class="block text-sm font-medium text-gray-700">
                                        Status</label>
                                    <input readonly type="text" name="exam_status[]" id="exam_status"
                                        autocomplete="data exame"
                                        @if ($protocolo->DATA === $hoje || $protocolo->DATA === $datafim) value="URGENTE" @else value="PENDENTE" @endif
                                        class="input input-bordered w-full max-w-xs">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Enviar fotos</label>
                <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                    <input type="file" name="photos[]" id="photos"
                        class="file-input file-input-bordered file-input-primary w-full max-w-xs" multiple />
                </div>
            </div>

            <label for="about" class="block text-sm font-medium text-gray-700">Observação
                do
                protocolo</label>
            <div class="mt-1">
                <textarea id="observacao" name="observacao" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    value=""></textarea>
            </div>

            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                <button type="submit" class="btn btn-primary mt-2">Salvar</button>
            </div>
        </form>
    @else
        <form action="{{ route('storewtprotocol') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="pb-5">
                <div class="col-span-6 sm:col-span-3 w-full my-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Paciente</label>
                    <input type="text" name="name" id="name" autocomplete="given-name" value=""
                        class="input input-bordered w-full ">
                </div>


                <div id="procedimento" class="col-span-6 sm:col-span-3 my-4">
                    <label for="last-name" class="block text-sm font-medium text-gray-700">Procedimento</label>
                    <input type="text" name="proced[]" id="proced" autocomplete="procedimento" value=""
                        class="input input-bordered w-full max-w-lg my-4">
                    <a type="button" class="btn btn-success cursor-pointer ml-2" onclick="addinput()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>

                    </a>
                </div>

                <div id="convenio" class="col-span-6 sm:col-span-3 pb-5 my-4">
                    <label for="last-name" class="block text-sm font-medium text-gray-700">Convênio</label>
                    <input type="text" name="convenio" id="convenio" autocomplete="convenio" value=""
                        class="input input-bordered w-full max-w-xs my-4">
                </div>

            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Enviar fotos</label>
                <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                    <input type="file" name="photos[]" id="photos"
                        class="file-input file-input-bordered file-input-primary w-full max-w-xs" multiple />
                </div>
            </div>

            <label for="about" class="block text-sm font-medium text-gray-700">Observação
                do
                protocolo</label>
            <div class="mt-1">
                <textarea id="observacao" name="observacao" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    value=""></textarea>
            </div>

            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                <button type="submit" class="btn btn-primary mt-2">Salvar</button>
            </div>
        </form>
    @endif


</div>
<script>
    function addinput() {
        var card = document.createElement("div");
        card.innerHTML =
            '<input type="text" name="proced[]" id="proced" autocomplete="procedimento" value="" class="input input-bordered w-full max-w-lg my-4">';


        var element = document.getElementById("procedimento");
        element.appendChild(card);


    }
</script>
