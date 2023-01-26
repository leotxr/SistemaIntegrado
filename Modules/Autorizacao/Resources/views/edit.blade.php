<head>
    @livewireStyles
</head>

<body>
    @livewireScripts
    <livewire:autorizacao::layouts.app />
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Solicitação') }}
        </h2>
    </div>

    <form name="formEdit" id="formEdit" method="post" action="{{ url('/update_exam/' . $protocol->id) }}">

        @csrf
        <div class="py-12" id="teste">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white">


                        <div class="p-2">
                            <div class="col-span-6 sm:col-span-3 font-bold">
                                <label name="paciente_name" id="paciente_name" autocomplete="exam_date"
                                    class="mt-1 block w-full rounded-md border-gray-300 sm:text-lg">
                                    {{ $protocol->paciente_name }}
                                    @if($protocol->observacao)
                                    <label for="my-modal" class="badge badge-outline badge-lg badge-accent">
                                        observações
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentcolor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                        </svg>

                                    </label>
                                    @else
                                    <div>
                                    </div>
                                    @endif


                                </label>
                            </div>

                            <div class="grid flex justify-items-end">
                                <button type="submit" class="proximo btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            @foreach ($protocol->relExams as $exams)
                                <div class="exam border border-2 p-2 m-2">
                                    <div class="grid grid-cols-1 sm:grid-cols-5 gap-4 font-bold bg-white p-2 ">
                                        <div class="p-2">
                                            <div class="max-w-sm">
                                                <label for="id" class="block text-sm font-medium text-gray-700">ID
                                                    interno
                                                </label>
                                                <input readonly type="text" name="exam_id[]" id="exam_id"
                                                    value="{{ $exams->id }}" autocomplete="exam_id"
                                                    class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>

                                        <div class="p-2">
                                            <div class="max-w-sm">
                                                <label for="exam_date"
                                                    class="block text-sm font-medium text-gray-700">Data
                                                    do
                                                    exame
                                                </label>
                                                <input type="date" name="exam_date[]" id="exam_date"
                                                    value="{{ $exams->exam_date }}" autocomplete="exam_date"
                                                    class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>

                                        <div class="p-2">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="exam_cod"
                                                    class="block text-sm font-medium text-gray-700">Cód.
                                                    Procedimento
                                                </label>
                                                <input readonly type="text" name="exam_cod" id="exam_cod"
                                                    value="{{ $exams->exam_cod ?? '' }}" autocomplete="exam_cod"
                                                    class="mt-1 block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>

                                        <div class="p-2">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="exam_name"
                                                    class="block text-sm font-medium text-gray-700">Procedimento
                                                </label>
                                                <input readonly type="text" name="exam_name" id="exam_name"
                                                    value="{{ $exams->name }}" autocomplete="exam_name"
                                                    class="mt-1 block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>

                                        <div class="p-2">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="convenio"
                                                    class="block text-sm font-medium text-gray-700">Convênio
                                                </label>
                                                <input readonly type="text" name="convenio" id="convenio"
                                                    value="{{ $exams->convenio }}" autocomplete="convenio"
                                                    class="mt-1 block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>


                                        <div class="p-2">
                                            <div class="col-span-6">
                                                <label for="exam_status"
                                                    class="block text-sm font-medium text-gray-700">Status</label>
                                                <select id="exam_status" name="exam_status[]" autocomplete="exam_status"
                                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                    <option value="{{ $exams->exam_status }}">{{ $exams->exam_status }}
                                                    </option>
                                                    <option value="AUTORIZADO">AUTORIZADO</option>
                                                    <option value="NEGADO">NEGADO</option>
                                                    <option value="AGUARDANDO">AGUARDANDO</option>
                                                </select>
                                            </div>
                                        </div>



                                    </div>
                                    <div>
                                        <label for="about"
                                            class="block text-sm font-medium text-gray-700">Observação
                                            do
                                            exame</label>
                                        <div class="mt-1">
                                            <textarea id="exam_obs" name="exam_obs[]" rows="3"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                value="{{ $exams->exam_obs }}"></textarea>
                                        </div>
                                    </div>

                                    <div class="grid flex justify-items-end p-6">


                                        <a type="button" class="proximo btn btn-primary gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                            </svg>
                                            Proximo
                                        </a>
                                    </div>

                                </div>
                            @endforeach


                            <div class="flex flex-row grid sm:grid-cols-10 gap-2 p-6">
                                @foreach ($protocol->relPhotos as $photos)
                                    <div class="h-16 w-16 glass">
                                        <a href="{{ URL::asset($photos->url) }}" target="_blank">
                                            <img src="{{ URL::asset($photos->url) }}" />
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="grid flex justify-items-end p-6">
                            <button type="submit" class="proximo btn btn-success gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
                                </svg>
                                Salvar
                            </button>
                        </div>

                    </div>


                </div>
            </div>



        </div>
    </form>


</body>


<input type="checkbox" id="my-modal" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Observações do protocolo</h3>
        <label for="about" class="block text-sm font-medium text-gray-700">Observação
            do
            protocolo</label>
        <div class="mt-1">
            <textarea readonly id="observacao" name="observacao" rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                value="{{ $protocol->observacao ?? '' }}">{{ $protocol->observacao ?? '' }}</textarea>
        </div>
        <div class="modal-action">
            <label for="my-modal" class="btn">Fechar</label>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        var telas = $(".row > .exam").length;
        $(".proximo").on("click", function() {

            $(this).closest(".exam").hide();

            var indice = $(".row a.proximo").index(this);

            indice += indice == telas - 1 ? -telas + 1 : 1;

            $(".row > .exam").eq(indice).show();
        });

    });
</script>

<style>
    .row>.exam:not(:first-child) {
        display: none;
    }
</style>
