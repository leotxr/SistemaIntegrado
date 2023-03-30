<div class="relative overflow-x-auto max-h-96">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        @csrf
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Assunto
                </th>
                <th scope="col" class="px-6 py-3">
                    Setor
                </th>
                <th scope="col" class="px-6 py-3">
                    Categoria
                </th>
                <th scope="col" class="px-6 py-3">
                    Data/Hora
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Ação
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($chamados_abertos as $chamado)
            @php
            $categoria = $chamado->find($chamado->id)->relCategory;
            $status = $chamado->find($chamado->id)->relStatus;
            @endphp
            <tr data-href="{{ route("ticket.edit", ['id'=>$chamado->id]) }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap dark:text-white">
                    <a href="{{ route("ticket.edit", ['id'=>$chamado->id]) }}">#{{$chamado->id}}</a>
                </th>
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <a href="{{ route("ticket.edit", ['id'=>$chamado->id]) }}">{{$chamado->assunto}}</a>
                </td>
                <td class="px-6 py-4">
                    Setor
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route("ticket.edit", ['id'=>$chamado->id]) }}">{{$categoria->nome}}</a>
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route("ticket.edit", ['id'=>$chamado->id]) }}">{{$chamado->hora_abertura}}</a>
                </td>
                <td class="px-6 py-4">
                    <span
                        class="bg-{{$status->status_cor}}-100 text-{{$status->status_cor}}-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-{{$status->status_cor}}-900 dark:text-{{$status->status_cor}}-300">{{$status->nome}}</span>
                </td>
                <td class="px-6 py-4 grid grid-cols-3 sm:grid-cols-3">
                    <a type="button" href="{{ url("helpdesk/chamados/$chamado->id/edit") }}" class="btn btn-success btn-sm btn-square">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="white" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                        </svg>
                    </a>
                    <button type="button" class="btn bg-blue-700 hover:bg-blue-800 btn-sm btn-square">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="white" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                    </button>
                    <button type="button" class="btn btn-error btn-sm btn-square">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="white" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>