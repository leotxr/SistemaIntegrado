<div class="grid sm:grid-cols-4 py-4 px-2 border">
    <h1 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Detalhes do Chamado:</h1>
    <div class="flex">
        <h1 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">#{{$chamado->id}} - </h1>
        <h1 class="mb-2 text-xl font-medium text-gray-900 dark:text-white">{{$chamado->assunto}} </h1>
    </div>

    <div>
        @php
        $categoria = $chamado->find($chamado->id)->relCategory;
        $status = $chamado->find($chamado->id)->relStatus;
        @endphp
        <span
            class="bg-{{$status->status_cor}}-100 text-{{$status->status_cor}}-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-{{$status->status_cor}}-900 dark:text-{{$status->status_cor}}-300">{{$status->nome}}</span>
    </div>

    <div class="flex">
        <div class="mais_acoes" id="mais_acoes">
            <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">Mais Ações <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg></button>

            <!-- Dropdown menu -->
            <div id="dropdownDivider"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDividerButton">
                    <li>
                        <form method="GET" action="{{url("helpdesk/chamados/$chamado->id/pausar")}}">
                            @csrf
                            <button type="submit"
                                class="flex px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mx-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.25 9v6m-4.5 0V9M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Pausar
                            </button>
                        </form>
                    </li>
                    <li>
                        <form method="GET" action="">
                            @csrf
                            <button type="submit"
                                class="flex px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mx-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>

                                Excluir</button>
                        </form>
                    </li>
                    <li>
                        <form method="GET" action="">
                            @csrf
                            <button type="submit"
                                class="flex px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mx-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Cancelar</button>
                        </form>
                    </li>
                </ul>
                <div class="py-2">
                    <button data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                        class="block px-4 py-2 w-full text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Inserir
                        Mensagem</button>
                </div>
            </div>


        </div>

        <div class="finalizar mx-2" id="finalizar">
            @if($chamado->status_id == 4)
                <button data-modal-target="staticModal" data-modal-toggle="staticModal"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Finalizar</button>
            @elseif($chamado->status_id == 7 || $chamado->status_id == 6 || $chamado->status_id == 5 )
                    <form method="GET" action="{{url("helpdesk/chamados/$chamado->id/reabrir")}}">
                    @csrf
                <button type="submit" id="reabrir"
                    class="focus:outline-none text-white bg-blue-400 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Reabrir</button>
            @else
                <form method="GET" action="{{url("helpdesk/chamados/$chamado->id/atender")}}">
                    @csrf
                    <button type="submit" id="atender"
                        class="focus:outline-none text-white bg-indigo-400 hover:bg-indigo-600 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                        Atender</button>
                </form>
            @endif
        </div>
    </div>

</div>

@include('helpdesk::layouts.partials.components.modal.end-ticket')
<x-helpdesk::modal> </x-helpdesk::modal>