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
                                    @if ($protocol->observacao)
                                        <label for="my-modal"
                                            class="badge badge-outline badge-lg badge-accent cursor-pointer pl-2">
                                            Observações
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
                                                    <option value="PENDENTE">PENDENTE</option>
                                                    <option value="URGENTE">URGENTE</option>
                                                </select>
                                            </div>
                                        </div>



                                    </div>
                                    <div>
                                        <label for="about" class="block text-sm font-medium text-gray-700">Observação
                                            do
                                            exame</label>
                                        <div class="mt-1">
                                            <textarea id="exam_obs" name="exam_obs[]" rows="3"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                value="{{ $exams->exam_obs }}"></textarea>
                                        </div>
                                    </div>


                                    <div class="grid flex sm:grid-cols-3 gap-2 justify-items-center p-6">

                                        @can('admin', 'administrativo')
                                        <label for="my-modal-6" type="button" id="excluir"
                                            class="btn btn-error gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                            Excluir
                                        </label>
                                        @endcan

                                        <!-- modal -->

                                        <input type="checkbox" id="my-modal-6" class="modal-toggle" />
                                        <div class="modal modal-bottom sm:modal-middle">
                                            <div class="modal-box">
                                                <h3 class="font-bold text-lg">Deseja excluir este protocolo?</h3>
                                                <p class="py-4">A solicitação será apagada do sistema</p>
                                                <div class="modal-action">
                                                    <label for="my-modal-6" class="btn btn-ghost">Fechar</label>
                                                    <a type="button"
                                                        href="{{ url('/destroy_protocol/' . $protocol->id) }}"
                                                        for="my-modal-6" class="btn btn-error">Confirmar</a>
                                                </div>
                                            </div>
                                        </div>

                                        @can('admin', 'administrativo')
                                        <button type="submit" class="salvar btn btn-success gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
                                            </svg>
                                            Salvar
                                        </button>
                                        @endcan


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


                            <div class="flex flex-row grid sm:grid-cols-10 grid-cols-5 gap-2 p-6">
                                @foreach ($protocol->relPhotos as $photos)
                                    <div class="h-16 w-16 glass">
                                        <a href="{{ URL::asset($photos->url) }}" target="_blank">
                                            <img src="{{ URL::asset($photos->url) }}" />
                                        </a>
                                    </div>
                                @endforeach
                            </div>
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
